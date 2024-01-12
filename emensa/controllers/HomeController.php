<?php

use emensa\components\MealCardComponent;

include("../models/besucher.php");
include("../models/meals.php");
include("../models/ratings.php");
include("../models/newsletter.php");


/* Datei: controllers/HomeController.php */

class HomeController
{
    public function index(RequestData $rd)
    {
        //Show dishes
        $displayMeals = displayMeals();
        $displayTestimonials = displayHomepageRatings();

        //Statistic data
        $queryVisitorCount = htmlspecialchars(queryVisitorCount()) ?? 'X';
        $newsletterCount = newsletterCount();
        $mealCount = htmlspecialchars(queryMealCount()) ?? 'X';

        // Log access to main page
        $log = logger();
        $log->info('Zugriff auf Hauptseite');
        return view('home', ['rd' => $rd, 'queryVisitorCount' => $queryVisitorCount, 'newsletterCount' => $newsletterCount, 'mealCount' => $mealCount, 'displayMeals' => $displayMeals, 'displayTestimonials' => $displayTestimonials]);
    }

    public function newsletter(RequestData $rd)
    {
        $name = ($_POST['name'] ?? NULL) ? preg_replace('/[^A-Za-z]+/', '', $_POST['name']) : NULL;
        $email = $_POST['email'] ?? NULL;
        $privacyPolicy = $_POST['privacyPolicy'] ?? NULL;

        $errors = array();

        if ($name == NULL) {
            $errors[] = "Der Name fehlt in der Eingabe.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Deine E-Mail entspricht nicht den Vorgaben.";
        } else if (str_contains($email, 'rcpt.at') or str_contains($email, 'damnthespam.at') or str_contains($email, 'wegwerfmail.de') or str_contains($email, 'trashmail.')) {
            $errors[] = "Deine E-Mail ist auf unsere Blockliste, bitte wähle eine andere.";
        }

        if ($privacyPolicy != "on") {
            $errors[] = "Du musst die Datenschutzbestimmungen akzeptieren";
        }

        /*
         * Speicher der Daten
         */
        if (count($errors) == 0) {
            $myfile = fopen("newsletter.csv", "a+") or die("Unable to open file!");
            fwrite($myfile, $name . ";");
            fwrite($myfile, $email . ";");
            fwrite($myfile, $privacyPolicy . PHP_EOL);
            fclose($myfile);
        }

        header("Refresh: 3; url=/");

        return view('newsletter', ['rd' => $rd, 'errors' => $errors, 'name' => $name, 'email' => $email]);
    }

    public function desired_meal(RequestData $rd)
    {
        if ($rd->method == 'GET') {
            return view('desired_meal', ['rd' => $rd]);
        }

        // Establish a new database connection to the MySQL database server
        $link = connectdb();

        // Sanitize user input and assign to variables
        $creator = mysqli_real_escape_string($link, $_POST['name']);
        $email = mysqli_real_escape_string($link, $_POST['mail']);
        $meal_name = mysqli_real_escape_string($link, $_POST['meal_name']);
        $description = mysqli_real_escape_string($link, $_POST['description']);

        /*
         * Input validation
         */
        $errors = array();
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Deine E-Mail entspricht nicht den Vorgaben.";
        }

        if (count($errors) == 0) {
            // If the creator is not in the database, insert it
            if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM ersteller_in WHERE email like '$email';")) < 1) {
                $result = mysqli_query($link, "INSERT INTO ersteller_in(name, email) VALUES ('$creator','$email');"); // If the
            }


            // If the meal is not in the database, insert it
            if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM wunschgericht WHERE name like '$meal_name';")) < 1) {
                $result = mysqli_query($link, "INSERT INTO wunschgericht(name, beschreibung, ersteller_in) VALUES ('$meal_name','$description','$email') ;");
                // Check if the query execution was successful
                if (!$result) {
                    // Display an error message and terminate the script if the query execution failed
                    $errors[] = "Fehler während der Besucher Datenbankabfrage:  " . mysqli_error($link);
                }
            } else {
                $errors[] = "Gericht wurde Bereits vorgeschlagen.";
            }
        }

        return view('desired_meal', ['rd' => $rd, 'success' => empty($errors), 'errors' => $errors]);
    }

    /**
     * This function is used to display the login page.
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function login(RequestData $request)
    {
        // Get the parameters from the session
        $errors = $_SESSION['login-errors'] ?? [];
        $redirect_reason = $_SESSION['login-redirect_reason'] ?? null;
        $redirect_url = $_SESSION['login-redirect_url'] ?? $_POST['login-redirect_url'] ?? null;
        // Clear the parameters from the session
        unset($_SESSION['login-errors']);
        unset($_SESSION['login-redirect_reason']);
        unset($_SESSION['login-redirect_url']);

        // Return the login view along with the request data, the errors, and the redirect reason and URL
        return view('login', ['rd' => $request, 'errors' => $errors, 'redirect_reason' => $redirect_reason, 'redirect_url' => $redirect_url]);
    }

    /**
     * This function is used to check the user's login credentials.
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function login_check(RequestData $request)
    {
        // Establish a new database connection to the MySQL database server
        $link = connectdb();

        // Check if the database connection was successful
        if (!$link) {
            exit();
        }

        // Retrieve the email and password from the POST data
        $email = $_POST['email'] ?? NULL;
        $password = $_POST['password'] ?? NULL;

        // Initialize an empty array to store any errors
        $errors = array();

        // Check if the email is not provided
        if ($email == NULL) {
            $errors[] = "Die E-Mail-Adresse fehlt in der Eingabe.";
        }

        // Check if the password is not provided
        if ($password == NULL) {
            $errors[] = "Das Passwort fehlt in der Eingabe.";
        }

        // Starts SQL transaction
        mysqli_begin_transaction($link, 0, 'login');

        // Prepare and execute the SQL statement to fetch the user details
        $stmt = $link->prepare("SELECT * FROM benutzer WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // logging
        $log = logger();

        // Check if the user exists and the password is correct
        if ($user == NULL) {
            $errors[] = "Der Benutzername oder das Passwort ist falsch.";
        } else {

            if (sha1(get_salt() . $password) == $user['password']) {
                $stmt = $link->prepare("CALL track_anmeldung(?);"); // Call the stored procedure to track the login
                $stmt->bind_param("s", $user['id']);
                $stmt->execute();

                // Remove the password from the user details
                unset($user['password']);
                // Store the user details in the session
                $_SESSION['user'] = $user;

                // log successful login
                $log->info('login', ['user' => $email]);
            } else {
                // Prepare and execute the SQL statement to update the user details
                $stmt = $link->prepare("UPDATE benutzer SET letzterfehler = NOW() WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();

                $errors[] = "Der Benutzername oder das Passwort ist falsch.";

                // log failed login
                $log->warning('failed login', ['user' => $email]);
            }

            // Saves SQL transaction
            mysqli_commit($link, 0, 'login');
        }

        // Check if the login was successful
        if (count($errors) <= 0) {
            $redirect_url = $_POST['redirect_url'];
            // Redirect to the index page or the redirect URL
            header('Location: ' . ($redirect_url ?? '/'), true, 303);
        } else {
            $_SESSION['login-redirect_reason'] = $_POST['redirect_reason'];
            $_SESSION['login-redirect_url'] = $_POST['redirect_url'];
            $_SESSION['login-errors'] = $errors;
            // If there are errors, return to the login page with the errors
            header('Location: /anmeldung', true, 303);
        }
    }

    /**
     * This function is used to display the user's profile page.
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function profile(RequestData $request)
    {
        // If the user is not logged in, redirect to the login page
        if (!isset($_SESSION['user'])) {
            // Set the parameters for the redirect URL
            $_SESSION['login-redirect_reason'] = 'Du musst angemeldet sein, um Dein Profil anzuzeigen.';
            $_SESSION['login-redirect_url'] = $_SERVER['REQUEST_URI'];
            // Redirect to the login page
            header('Location: /anmeldung', true, 303);
        }

        // Return the profile view along with the request data and the user details
        return view('profile', ['rd' => $request, 'user' => $_SESSION['user']]);
    }


    /**
     * This function is used to log the user out.
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function logout(RequestData $request, array $errors = array()): string
    {
        // log logout
        $log = logger();
        $log->info('logout', ['user' => $_SESSION['user']['email']]);

        // Logs the user out
        unset($_SESSION['user']);

        // Redirects the user to the index page
        header('Location: /', true, 303);
        return '';
    }

    /**
     * This function is used to display the rating page.
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function rating(RequestData $request): string
    {
        $meal_id = $_GET['meal_id'];
        $rating = $_GET['rating'];
        $comment = $_SESSION['rating-comment'] ?? NULL;
        $errors = $_SESSION['rating-errors'] ?? [];
        // Clear the parameters from the session
        unset($_SESSION['rating-comment']);
        unset($_SESSION['rating-errors']);

        // If the user is not logged in, redirect to the login page
        if (!isset($_SESSION['user'])) {

            // Set the parameters for the redirect URL
            $_SESSION['login-redirect_reason'] = 'Du musst angemeldet sein, um eine Bewertung abzugeben.';
            // current url
            $_SESSION['login-redirect_url'] = $_SERVER['REQUEST_URI'];
            // Redirect to the login page
            header('Location: /anmeldung', true, 303);
        }

        // log access to rating page
        $log = logger();
        $log->info('Zugriff auf Bewertungsseite');

        // Establish a new database connection to the MySQL database server
        $link = connectdb();

        // Check if the database connection was successful
        if (!$link) {
            header('Location: /', true, 303);
        }

        // If no meal id is provided, redirect to the index page
        if ($meal_id == NULL) {
            header('Location: /', true, 303);
        }

        // Prepare and execute the SQL statement to fetch the meal details
        $result = queryMeals(-1, $meal_id);

        // If the meal does not exist, redirect to the index page
        if (count($result) <= 0) {
            header('Location: /', true, 303);
        }

        $meal = $result[0];

        // Return the rating view along with the request data and the meal details
        return view('rating', ['rd' => $request, 'meal' => $meal, 'rating' => $rating, 'comment' => $comment, 'meal_card' => new MealCardComponent($meal, true), 'errors' => $errors]);
    }

    /**
     * This function is used to check the input values of the rating form and save the data in the database
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function submit_rating(RequestData $request)
    {
        // Retrieve the form entries from the POST data
        $comment = $_POST['comment'] ?? NULL;
        $rating = $_POST['rating'] ?? NULL;
        $meal_id = $_POST['meal_id'] ?? NULL;

        $redirect_url = "/bewertung?meal_id=$meal_id&rating=$rating";

        // Establish a new database connection to the MySQL database server
        $link = connectdb();

        // Check if the database connection was successful
        if (!$link) {
            $_SESSION['rating-comment'] = $comment;
            $_SESSION['rating-errors'] = ["Verbindung zur Datenbank fehlgeschlagen: ", mysqli_connect_error()];
            header("Location: $redirect_url", true, 303);
        }

        // Retrieve the user details from the session
        $benutzer_id = $_SESSION['user']['id'] ?? NULL;

        // Initialize an empty array to store any errors
        $errors = array();

        // Check if comment is not provided
        if ($comment == NULL) {
            $errors[] = "Der Bewertungstext fehlt in der Eingabe.";
        } // Check if comment is too short
        else if (strlen($comment) < 5) {
            $errors[] = "Der Bewertungstext ist zu kurz.";
        } // Check if comment is too long
        else if (strlen($comment) > 500) {
            $errors[] = "Der Bewertungstext ist zu lang.";
        }

        // Check if rating is not provided
        if ($rating == NULL) {
            $errors[] = "Die Bewertung (Sterne) fehlt in der Eingabe.";
        }

        // Check if rating is a valid input
        if ($rating < 1 or $rating > 4) {
            $errors[] = "Die Bewertung (Sterne) ist nicht gültig.";
        }

        // Check if user is not logged in
        if ($benutzer_id == NULL) {
            $errors[] = "Du musst angemeldet sein um eine Bewertung abgeben zu können.";
        }

        // Check if meal_id is not provided
        if ($meal_id == NULL) {
            $errors[] = "Das Gericht fehlt in der Eingabe.";
        }

        // Checks if user already made a rating for that meal
        $stmt = $link->prepare("SELECT COUNT(*) FROM bewertung WHERE gericht_id = ? AND benutzer_id = ?");
        $stmt->bind_param("ss", $meal_id, $benutzer_id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        if ($result > 0) {
            $errors[] = "Du kannst nicht mehrere Bewertungen für ein Gericht abgeben.";
        }
        $stmt->close();

        // Saves rating in daterbase
        if (empty($errors)) {
            $stmt = $link->prepare("INSERT INTO bewertung (bemerkung, sterne, benutzer_id, gericht_id) VALUE (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $comment, $rating, $benutzer_id, $meal_id);
            $stmt->execute();
            mysqli_commit($link, 0, 'rating');
            $stmt->close();
        }
        $link->close();

        if (count($errors) > 0) {
            // If there are errors, return to the rating page with the errors
            $_SESSION['rating-comment'] = $comment;
            $_SESSION['rating-errors'] = $errors;
            header("Location: $redirect_url", true, 303);
            return;
        }

        // Redirect to the index page or the redirect URL
        header('Location: /', true, 303);
    }

    /**
     * This funktions is used to delete rating
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function delete_rating(RequestData $request): void
    {
        // Establish a new database connection to the MySQL database server
        $link = connectdb();

        $redirect_url = "/bewertung";

        // Check if the database connection was successful
        if (!$link) {
            $_SESSION['delete-rating-errors'] = ["Verbindung zur Datenbank fehlgeschlagen: ", mysqli_connect_error()];
            header("Location: $redirect_url", true, 303);
        }

        // Retrieve meal_id from POST data
        $meal_id = $_POST['meal_id'] ?? NULL;

        // Retrieve the user id from the session
        $benutzer_id = $_SESSION['user']['id'] ?? NULL;

        // Initialize an empty array to store any errors
        $errors = array();

        // Check if user is not logged in
        if ($benutzer_id == NULL) {
            $errors[] = "Du musst angemeldet sein um deine Bewertung löschen zu können.";
        }

        // Check if meal_i is not provided
        if ($meal_id == NULL) {
            $errors[] = "Das Gericht fehlt in der Eingabe.";
        }

        // deletes rating
        if (empty($errors)) {
            $stmt = $link->prepare("DELETE FROM bewertung WHERE benutzer_id = ? AND gericht_id = ?;");
            $stmt->bind_param("ss", $benutzer_id, $meal_id);
            $stmt->execute();
            mysqli_commit($link, 0, 'delete_rating');
            $stmt->close();
        }
        $link->close();

        if (count($errors) > 0) {
            // If there are errors, return to the rating page with the errors
            $_SESSION['rating-errors'] = $errors;
            return;
        }

        // Redirect to the index page or the redirect URL
        header('Location: /', true, 303);
    }

    /**
     * This function is used to display the last 30 ratings.
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function ratings(RequestData $request)
    {
        $errors = $_SESSION['rating-errors'] ?? [];
        unset($_SESSION['rating-errors']);

        // Establish a new database connection to the MySQL database server
        $link = connectdb();

        // Prepare and execute the SQL statement to fetch the last 30 ratings
        $result = mysqli_query($link, "SELECT sterne+0 AS sterne, bemerkung, hervorgehoben, benutzer.name AS benutzername, gericht.name AS gerichtname, bildname, gericht_id, benutzer_id FROM bewertung INNER JOIN gericht ON bewertung.gericht_id = gericht.id INNER JOIN benutzer ON benutzer_id = benutzer.id ORDER BY zeitpunkt LIMIT 30;");
        $ratings = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Return the ratings view along with the request data and the ratings
        return view('ratings', ['rd' => $request, 'ratings' => $ratings, 'is_admin' => $_SESSION['user']['admin'] ?? false, 'errors' => $errors]);
    }

    /**
     * This function is used to display the user's ratings page.
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function user_ratings(RequestData $request)
    {
        // Establish a new database connection to the MySQL database server
        $link = connectdb();

        // Check if the database connection was successful
        if (!$link) {
            exit();
        }

        // Retrieve the user id from the session
        $benutzer_id = $_SESSION['user']['id'] ?? NULL;

        // Check if user is not logged in
        if ($benutzer_id == NULL) {
            $_SESSION['login-redirect_reason'] = 'Du musst angemeldet sein, um deine Bewertungen anzuzeigen.';
            $_SESSION['login-redirect_url'] = $_SERVER['REQUEST_URI'];
            // Redirect to the login page
            header('Location: /anmeldung', true, 303);
            return '';
        }

        // Prepare and execute the SQL statement to fetch the user's ratings
        $stmt = $link->prepare("SELECT * FROM bewertung INNER JOIN gericht ON bewertung.gericht_id = gericht.id WHERE bewertung.benutzer_id = ?;");
        $stmt->bind_param("s", $benutzer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $ratings = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        // Return the ratings view along with the request data and the ratings
        return view('ratings', ['rd' => $request, 'ratings' => $ratings]);
    }

    /**
     * This funktion is used to let administrator highlight rating
     * @param RequestData $request
     */
    public function highlight_rating(RequestData $request): void
    {
        // Establish a new database connection to the MySQL database server
        $link = connectdb();

        // Retrieve meal_id from POST data
        $meal_id = $_POST['meal_id'] ?? NULL;
        $user_id = $_POST['user_id'] ?? NULL;

        // Initialize an empty array to store any errors
        $errors = array();

        if ($_SESSION['user'] == NULL) { // Check if user is not logged in
            $errors[] = "Du musst angemeldet sein um Bewertung hervorheben zu können.";
        } else if (!$_SESSION['user']['admin']) { // Check if the user is an administrator
            $errors[] = "Du musst Administrator sein, um Bewertung hervorheben zu können.";
        } else if ($meal_id == null) { // Check if meal_id is not provided
            $errors[] = "Das Gericht fehlt in der Eingabe.";
        } else { // Check if rating is already highlighted
            $stmt = $link->prepare("SELECT count(*) FROM bewertung WHERE benutzer_id = ? AND gericht_id = ? AND hervorgehoben = TRUE;");
            $stmt->bind_param("ii", $user_id, $meal_id);
            $stmt->execute();
            $stmt->bind_result($result);
            $stmt->fetch();
            $stmt->close();
            if ($result == 1) {
                $errors[] = "Diese Bewertung ist bereits hervorgehoben.";
            }
        }

        // highlight rating
        if (empty($errors)) {
            $stmt = $link->prepare("UPDATE bewertung SET hervorgehoben = TRUE WHERE benutzer_id = ? AND gericht_id = ?;");
            $stmt->bind_param("ii", $user_id, $meal_id);
            $stmt->execute();
            mysqli_commit($link, 0, 'highlight_rating');
            $stmt->close();
        }
        $link->close();

        if (count($errors) > 0) {
            // If there are errors, set the errors in the session and return to the rating page
            $_SESSION['rating-errors'] = $errors;
        }

        // Redirect to the ratings page
        header("Location: /bewertungen", true, 303);
    }

    /**
     * This funktion is used to let administrator unhighlight rating
     * @param RequestData $request
     */
    public function unhighlight_rating(RequestData $request): void
    {
        // Establish a new database connection to the MySQL database server
        $link = connectdb();

        // Retrieve meal_id from POST data
        $meal_id = $_POST['meal_id'] ?? NULL;
        $user_id = $_POST['user_id'] ?? NULL;

        // Initialize an empty array to store any errors
        $errors = array();

        if ($_SESSION['user'] == NULL) { // Check if user is not logged in
            $errors[] = "Du musst angemeldet sein um Bewertung hervorheben zu können.";
        } else if (!$_SESSION['user']['admin']) { // Check if the user is an administrator
            $errors[] = "Du musst Administrator sein, um Bewertung hervorheben zu können.";
        } else if ($meal_id == null) { // Check if meal_id is not provided
            $errors[] = "Das Gericht fehlt in der Eingabe.";
        } else { // Check if rating is highlighted
            $stmt = $link->prepare("SELECT count(*) FROM bewertung WHERE benutzer_id = ? AND gericht_id = ? AND hervorgehoben = TRUE;");
            $stmt->bind_param("ii", $user_id, $meal_id);
            $stmt->execute();
            $stmt->bind_result($result);
            $stmt->fetch();
            $stmt->close();
            if ($result != 1) {
                $errors[] = "Diese Bewertung ist nicht hervorgehoben.";
            }
        }

        // dehighlight rating
        if (empty($errors)) {
            $stmt = $link->prepare("UPDATE bewertung SET hervorgehoben = FALSE WHERE benutzer_id = ? AND gericht_id = ?;");
            $stmt->bind_param("ss", $user_id, $meal_id);
            $stmt->execute();
            mysqli_commit($link, 0, 'highlight_rating');
            $stmt->close();
        }
        $link->close();

        if (count($errors) > 0) {
            // If there are errors, return to the rating page with the errors
            $_SESSION['rating-errors'] = $errors;
        }

        // Redirect to the index page or the redirect URL
        header('Location: /bewertungen', true, 303);
    }

    public function debug(RequestData $request)
    {
        return view('debug');
    }
}