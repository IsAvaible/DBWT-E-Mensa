<?php

use emensa\components\MealCardComponent;

require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/gericht.php');
include("../models/besucher.php");
include("../models/meals.php");
include("../models/newsletter.php");


/* Datei: controllers/HomeController.php */

class HomeController
{
    public function index(RequestData $rd)
    {
        //Show dishes
        $displayMeals = displayMeals();

        //Statistic data
        $queryVisitorCount = htmlspecialchars(queryVisitorCount()) ?? 'X';
        $newsletterCount = newsletterCount();
        $mealCount = htmlspecialchars(queryMealCount()) ?? 'X';

        // Log access to main page
        $log = logger();
        $log->info('Zugriff auf Hauptseite');
        return view('home', ['rd' => $rd, 'queryVisitorCount' => $queryVisitorCount, 'newsletterCount' => $newsletterCount, 'mealCount' => $mealCount, 'displayMeals' => $displayMeals]);
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
            $errors[] = "Ihre E-Mail entspricht nicht den Vorgaben.";
        } else if (str_contains($email, 'rcpt.at') or str_contains($email, 'damnthespam.at') or str_contains($email, 'wegwerfmail.de') or str_contains($email, 'trashmail.')) {
            $errors[] = "Ihre E-Mail ist auf unsere Blockliste, bitte wählen sie eine andere.";
        }

        if ($privacyPolicy != "on") {
            $errors[] = "Sie müssen die Datenschutzbestimmungen akzeptieren";
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

        // Check if the database connection was successful
        if (!$link) {
            exit();
        }

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
            $errors[] = "Ihre E-Mail entspricht nicht den Vorgaben.";
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
        $redirect_url = $_SESSION['login-redirect_url'] ?? null;
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
            $_SESSION['login-redirect_reason'] = 'Sie müssen angemeldet sein, um Ihr Profil anzuzeigen.';
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
        return $this->index($request);
    }

    /**
     * This function is used to display the rating page.
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function rating(RequestData $request): string
    {
        $meal_id = $_GET['meal_id'];
        $rating = $_GET['rating'];

        // If the user is not logged in, redirect to the login page
        if (!isset($_SESSION['user'])) {

            // Set the parameters for the redirect URL
            $_SESSION['login-redirect_reason'] = 'Sie müssen angemeldet sein, um eine Bewertung abzugeben.';
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

        // Prepare and execute the SQL statement to fetch the meal details
        $result = queryMeals(-1, $meal_id);

        // If the meal does not exist, redirect to the index page
        if (count($result) <= 0) {
            header('Location: /', true, 303);
        }

        $meal = $result[0];

        // Return the rating view along with the request data and the meal details
        return view('rating', ['rd' => $request, 'meal' => $meal, 'rating' => $rating, 'meal_card' => new MealCardComponent($meal, true)]);
    }

    public function debug(RequestData $request)
    {
        return view('debug');
    }

    /**
     * This function is used to check the input values of the rating form and save the data in the database
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function check_rating(RequestData $request)
    {

        // Establish a new database connection to the MySQL database server
        $link = connectdb();

        // Check if the database connection was successful
        if (!$link) {
            exit();
        }

        // Retrieve the Formal entries from the POST data
        $comment = $_POST['comment'] ?? NULL;
        $rating = $_POST['$rating'] ?? NULL;
        $benutzer_id = $_SESSION['user']["email"] ?? NULL;
        $meal_id = $_POST['meal_id'] ?? NULL;

        // Initialize an empty array to store any errors
        $errors = array();

        // Check if comment is not provided
        if ($comment == NULL) {
            $errors[] = "Der Bewertungstext fehlt in der Eingabe.";
        }

        // Cleans Bewertung for SQL
        $bewertung = mysqli_real_escape_string($link, $comment);

        // Check if Sterne is not provided
        if ($rating == NULL) {
            $errors[] = "Die Bewertung (Sterne) fehlt in der Eingabe.";
        }

        // Check if Sterne is a valid input
        if ($rating < 1 or $rating > 4) {
            $errors[] = "Die Bewertung (Sterne) ist nicht gültig.";
        }

        // Check if Benutzer is not logged in
        if ($benutzer_id == NULL) {
            $errors[] = "Sie müssen angemeldet sein um eine Bewertung abgeben zu können.";
        }

        // Check if gericht_id is not provided
        if ($meal_id == NULL) {
            $errors[] = "Die Gericht fehlt in der Eingabe.";
        }

        if (empty($errors)) {
            $stmt = $link->prepare("INSERT INTO bewertung (bemerkung, sterne, benutzer_id, gericht_id) VALUE (?, ?, ?, ?)");
            $stmt = $link->bind_param("ssss", $comment, $rating, $benutzer_id, $meal_id);
            $stmt->execute();
            mysqli_commit($link, 0, 'login');
            $stmt->close();
            $link->close();
        }

        if (count($errors) > 0) {
            // If there are errors, return to the rating page with the errors
            return $this->rating($request, $errors);
        } else {
            // If there are no errors, return to the index page
            return $this->rating($request);
        }

    }
}