<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

// Sanitize user input and assign to variables
$name = preg_replace('/[^A-Za-z ]+/', '', $_POST['name'] ?? NULL); // Remove any non-alphabetic characters from name
$email = $_POST['mail'] ?? NULL;
$lang = $_POST['lang'] ?? NULL;
$privacyPolicy = $_POST['datenschutz'] ?? NULL;

$error = array(); // Initialize an array to store error messages

/*
 * Input validation
 */
// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error[] = "Deine E-Mail entspricht nicht den Vorgaben.";
}

// Check if email is not from a disposable email service
if (str_contains($email, 'rcpt.at') or str_contains($email, 'damnthespam.at') or str_contains($email, 'wegwerfmail.de') or str_contains($email, 'trashmail.')) {
    $error[] = "Deine E-Mail ist auf unsere Blogliste, bitte wähle eine andere.";
}

// Validate language input
if ($lang != "de" and $lang != "en") {
    $error[] = "Die Sprache wurde falsch eingegeben.";
}

// Check if privacy policy is accepted
if ($privacyPolicy != "on") {
    $error[] = "Du musst die Datenschutzbestimmungen akzeptieren";
}

// If there are no errors, write the data to a CSV file
if (count($error) == 0) {
    $myfile = fopen("newsletter.csv", "a+") or die("Unable to open file!"); // Open the file or exit if it can't be opened
    fwrite($myfile, $name . ";");                                           // Write the name to the file
    fwrite($myfile, $email . ";");                                          // Write the email to the file
    fwrite($myfile, $lang . ";");                                           // Write the language to the file
    fwrite($myfile, $privacyPolicy . PHP_EOL);                              // Write the privacy policy acceptance to the file
    fclose($myfile);                                                        // Close the file
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
    echo htmlspecialchars($name) . "<br>";
    echo htmlspecialchars($email) . "<br>";
    echo "Gewünschte Sprache: " . htmlspecialchars($lang) . "<br>";
    echo "Datenschutzbestimmungen akzeptiert";
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
