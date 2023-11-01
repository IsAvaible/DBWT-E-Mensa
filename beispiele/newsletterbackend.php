<?php

/*
 * anrede
 * vorname
 * nachname
 * email
 *
 * datenschutz
 */

$anrede = $_POST['anrede'] ?? NULL;
$vorname = $_POST['vorname'] ?? NULL;
$nachname = $_POST['nachname'] ?? NULL;
$email = $_POST['email'] ?? NULL;
$benint = $_POST['benint'] ?? NULL;
$datenschutz = $_POST['datenschutz'] ?? NULL;

$fehler = array();

/*
 * Eingabe Prüefen
 */
if ($anrede != "herr" and $anrede != "frau" and $anrede != "divers") {
    array_push($fehler, "Die Anrede wurde falsch eingabe.");
}

if ($vorname == NULL) {
    //$fehler = "Der Vorname fehlt in der eingabe.";
    array_push($fehler, "Der Vorname fehlt in der eingabe.");
}

if ($nachname == NULL) {
    array_push($fehler, "Der Nachname fehlt in der eingabe.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($fehler, "Ihre E-Mail entspricht nicht den Vorgaben.");
}

if ($benint != "täglich" and $benint != "wöchentlich" and $benint != "monatlich") {
    array_push($fehler, "Der Benachrichtigungsinterval wurde falsch eingabe.");
}

if ($datenschutz != "on") {
    array_push($fehler, "Sie müssen die Datenschutzbestimmungen akzeptieren");
}

/*
 * Speicher der Daten
 */
if (count($fehler) == 0) {
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

if (count($fehler) == 0) {
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
