<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
/*
 * in this file, the data from the form "wunschgericht" is entered into the database.
 */

// Establish a new database connection to the MySQL database server
$link = mysqli_connect("localhost", "root", "root", "emensawerbeseite");

// Check if the database connection was successful
if (!$link) {
    // Display an error message and terminate the script if the connection failed
    echo "Verbindung zur Datenbank fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

// Sanitize user input and assign to variables
$ersteller_in = preg_replace('/[^A-Za-z ]+/', '', $_POST['name'] ?? NULL); // Remove any non-alphabetic characters from name
$email = $_POST['mail'] ?? NULL;
$gerichtname = preg_replace('/[^A-Za-z0-9?!. ]+/', '', $_POST['gerichtname'] ?? NULL); // Remove any non-alphabetic characters from gerichtname
$beschreibung = preg_replace('/[^A-Za-z0-9?!. ]+/', '', $_POST['beschreibung'] ?? NULL); // Remove any non-alphabetic characters from beschreibung

$error = array(); // Initialize an array to store error messages

/*
 * Input validation
 */

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error[] = "Ihre E-Mail entspricht nicht den Vorgaben.";
}

// Check if name is not empty
if ($gerichtname == NULL) {
    $error[] = "Der Gerichtname enthält nicht erlabute Zeichen.";
}

// Check if name is not empty
if ($beschreibung == NULL) {
    $error[] = "Die Beschreibung enthält nicht erlabute Zeichen.";
}

// If there are no errors, write the data to a CSV file
if (count($error) == 0) {
    //INSERT ersteller_in
    $sql_ersteller_in = mysqli_real_escape_string($link, $ersteller_in); //Parsing for SQL
    $sql_email = mysqli_real_escape_string($link, $email); //Parsing for SQL

    if (NULL == $ersteller_in) {
        $query_ersteller_in = "INSERT INTO ersteller_in(email) VALUES ('$sql_email');";
    } else {
        $query_ersteller_in = "INSERT INTO ersteller_in(name, email) VALUES ('$sql_ersteller_in','$sql_email');";
    }

    //Check if erstelleri_in already exist
    $existing_erstelleri_in = mysqli_query($link, "SELECT * FROM ersteller_in WHERE email like '$sql_email';");
    if (mysqli_num_rows($existing_erstelleri_in) < 1) {
        $result = mysqli_query($link, $query_ersteller_in);
    }


    //INSERT Gericht
    $sql_gerichtname = mysqli_real_escape_string($link, $gerichtname); //Parsing for SQL
    $sql_beschreibung = mysqli_real_escape_string($link, $beschreibung); //Parsing for SQL
    $query_gericht = "INSERT INTO wunschgericht(name, beschreibung, ersteller_in) VALUES ('$sql_gerichtname','$sql_beschreibung','$email') ;";

    //checks if gericht already exist
    $existing_erstelleri_in = mysqli_query($link, "SELECT * FROM wunschgericht WHERE name like '$sql_gerichtname';");
    if (mysqli_num_rows($existing_erstelleri_in) < 1) {
        $result = mysqli_query($link, $query_gericht);
    } else {
        $error[] = "Gericht wurde Bereits vorgeschlagen.";
    }

    // Check if the query execution was successful
    if (!$result) {
        // Display an error message and terminate the script if the query execution failed
        echo "Fehler während der Besucher Datenbankabfrage:  ", mysqli_error($link);
        return -1;
    }

}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Verarbeitung Newsletter Anmeldung</title>
</head>
<body style="font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Open Sans, Helvetica Neue, sans-serif;">
<?php

// If there are no errors, display a success message
if (count($error) == 0) {
    echo "<h3>Erfolgreiche Anmeldung. </h3>";
    echo $ersteller_in . "<br>";
    echo $email . "<br>";
    echo $gerichtname . "<br>";
    echo $beschreibung . "<br>";
} else {
    // If there are errors, display them
    echo "<h3>Leider ist ein Fehler aufgetreten.</h3>";
    foreach ($error as $meldung) {
        echo $meldung . "<br>";
    }
}

// After 3 seconds, redirect to index.php
header("Refresh: 3; url=index.php");
?>
</body>
