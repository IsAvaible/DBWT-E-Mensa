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
        $gerichteDarstellen = gerichte_dartsellen();

        //Statistic data
        $queryVisitorCount = htmlspecialchars(queryVisitorCount()) ?? 'X';
        $newsletterCount = newsletterCount();
        $mealCount = htmlspecialchars(queryMealCount()) ?? 'X';

        return view('home', ['rd' => $rd, 'queryVisitorCount' => $queryVisitorCount, 'newsletterCount' => $newsletterCount, 'mealCount' => $mealCount, 'gerichteDarstellen' => $gerichteDarstellen]);
    }

    public function newsletter(RequestData $rd)
    {
        $title = $_POST['title'] ?? NULL;
        $name = preg_replace('/[^A-Za-z]+/', '', $_POST['name'] ?? NULL);
        $email = $_POST['email'] ?? NULL;
        $privacyPolicy = $_POST['privacyPolicy'] ?? NULL;

        $errors = array();

        /*
         * Eingabe Prüefen
         */
        if ($title != "herr" and $title != "frau" and $title != "divers") {
            $errors[] = "Die Anrede wurde falsch eingabe.";
        }

        if ($name == NULL) {
            $errors[] = "Der Name fehlt in der eingabe.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Ihre E-Mail entspricht nicht den Vorgaben.";
        }

        if (str_contains($email, 'rcpt.at') or str_contains($email, 'damnthespam.at') or str_contains($email, 'wegwerfmail.de') or str_contains($email, 'trashmail.')) {
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
            fwrite($myfile, $title . ";");
            fwrite($myfile, $name . ";");
            fwrite($myfile, $email . ";");
            fwrite($myfile, $privacyPolicy . PHP_EOL);
            fclose($myfile);
        }

        return view('newsletter', ['rd' => $rd, 'errors' => $errors, 'title' => $title, 'name' => $name, 'email' => $email]);
    }

    public function desired_meal(RequestData $rd)
    {
        if ($rd->method == 'GET') {
            return view('desired_meal', ['rd' => $rd]);
        }

        // Establish a new database connection to the MySQL database server
        $link = mysqli_connect("localhost", "root", "root", "emensawerbeseite");

        // Check if the database connection was successful
        if (!$link) {
            // Display an error message and terminate the script if the connection failed
            echo "Verbindung zur Datenbank fehlgeschlagen: ", mysqli_connect_error();
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

    public function debug(RequestData $request)
    {
        return view('debug');
    }
}