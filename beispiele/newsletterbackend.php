<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */


$anrede = $_POST['anrede'] ?? NULL;
$vorname = preg_replace('/[^A-Za-z]+/', '', $_POST['vorname'] ?? NULL);
$nachname = preg_replace('/[^A-Za-z]+/', '', $_POST['nachname'] ?? NULL);
$email = $_POST['email'] ?? NULL;
$benint = $_POST['benint'] ?? NULL;
$datenschutz = $_POST['datenschutz'] ?? NULL;

$fehler = array();

/*
 * Eingabe Prüefen
 */
if ($anrede != "herr" and $anrede != "frau" and $anrede != "divers") {
    array_push($fehler, "Die Anrede wurde falsch eingegeben.");
}

if ($vorname == NULL) {
    //$fehler = "Der Vorname fehlt in der eingabe.";
    array_push($fehler, "Der Vorname fehlt in der eingabe.");
}

if ($nachname == NULL) {
    array_push($fehler, "Der Nachname fehlt in der eingabe.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($fehler, "Deine E-Mail entspricht nicht den Vorgaben.");
}

if (str_contains($email, 'rcpt.at') or str_contains($email, 'damnthespam.at') or str_contains($email, 'wegwerfmail.de') or str_contains($email, 'trashmail.')) {
    array_push($fehler, "Deine E-Mail ist auf unsere Blogliste, bitte wähle eine andere.");
}

if ($benint != "täglich" and $benint != "wöchentlich" and $benint != "monatlich") {
    array_push($fehler, "Der Benachrichtigungsinterval wurde falsch eingabe.");
}

if ($datenschutz != "on") {
    array_push($fehler, "Du musst die Datenschutzbestimmungen akzeptieren");
}

/*
 * Speicher der Daten
 */
if (empty($fehler)) {
    $myfile = fopen("newsletter.csv", "a+") or die("Unable to open file!");
    fwrite($myfile, $anrede . ";");
    fwrite($myfile, $vorname . ";");
    fwrite($myfile, $nachname . ";");
    fwrite($myfile, $email . ";");
    fwrite($myfile, $benint . ";");
    fwrite($myfile, $datenschutz . PHP_EOL);
    fclose($myfile);
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Verarbeitung Newsletter Anmeldung</title>
</head>
<body style="font-family: 'Comic Sans MS'">
<?php

if (empty($fehler)) {
    echo "<h3>Erfolgreiche Anmeldung. </h3>";
    echo $anrede . " " . $vorname . " " . $nachname . "<br>";
    echo $email . "<br>";
    echo "Benachrichtigungsinterval: " . $benint . "<br>";
    echo "Datenschutzbestimmungen akzeptiert";
} else {
    echo "<h3>Leider ist ein Fehler aufgetreten.</h3>";
    foreach ($fehler as $meldung) {
        echo $meldung . "<br>";
    }
}
?>
</body>
