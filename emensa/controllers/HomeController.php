<?php
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
     * @param array $errors This is an optional parameter. It is an array that contains any errors that occurred during the login process.
     */
    public function login(RequestData $request, array $errors = array())
    {
        // Return the login view along with the request data and any errors
        return view('login', ['rd' => $request, 'errors' => $errors]);
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

        // Check if the user exists and the password is correct
        if ($user == NULL) {
            $errors[] = "Der Benutzername oder das Passwort ist falsch.";
        } else {

            if (sha1(get_salt() . $password) == $user['password']) {
                $stmt = $link->prepare("UPDATE benutzer SET anzahlanmeldungen = anzahlanmeldungen + 1, letzteanmeldung = NOW() WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();

                // Remove the password from the user details
                unset($user['password']);
                // Store the user details in the session
                $_SESSION['user'] = $user;
            } else {
                // Prepare and execute the SQL statement to update the user details
                $stmt = $link->prepare("UPDATE benutzer SET letzterfehler = NOW() WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();

                $errors[] = "Der Benutzername oder das Passwort ist falsch.";
            }

            // Saves SQL transaction
            mysqli_commit($link, 0, 'login');
        }

        if (count($errors) > 0) {
            // If there are errors, return to the login page with the errors
            return $this->login($request, $errors);
        } else {
            header('Location: /');
            // If there are no errors, return to the index page
            return $this->index($request);
        }
    }

    /**
     * This function is used to display the user's profile page.
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function profile(RequestData $request)
    {
        // Check if the user is logged in
        if (!isset($_SESSION['user'])) {
            // If the user is not logged in, redirect to the login page
            return $this->login($request);
        }

        // Return the profile view along with the request data and the user details
        return view('profile', ['rd' => $request, 'user' => $_SESSION['user']]);
    }


    /**
     * This function is used to log the user out.
     * @param RequestData $request This is an instance of RequestData class. It contains the request data.
     */
    public function logout(RequestData $request, array $errors = array())
    {
        // Logs the user out
        unset($_SESSION['user']);

        // Redirects the user to the index page
        return $this->index($request);
    }

    public function debug(RequestData $request)
    {
        return view('debug');
    }
}