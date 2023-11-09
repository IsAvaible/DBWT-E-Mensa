<?php

/*
 * anrede
 * vorname
 * nachname
 * email
 *
 * datenschutz
 */

$name = preg_replace('/[^A-Za-z ]+/', '', $_POST['name'] ?? NULL);
$email = $_POST['mail'] ?? NULL;
$lang = $_POST['lang'] ?? NULL;
$datenschutz = $_POST['datenschutz'] ?? NULL;

$fehler = array();

/*
 * Eingabe Prüefen
 */
if ($name == NULL) {
    array_push($fehler, "Der Name enthält nicht erlabute Zeichen.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($fehler, "Ihre E-Mail entspricht nicht den Vorgaben.");
}

if (str_contains($email, 'rcpt.at') or str_contains($email, 'damnthespam.at') or str_contains($email, 'wegwerfmail.de') or str_contains($email, 'trashmail.')) {
    array_push($fehler, "Ihre E-Mail ist auf unsere Blogliste, bitte Wählen sie eine andere.");
}

if ($lang != "de" and $lang != "en") {
    array_push($fehler, "Der Sprache wurde falsch eingabe.");
}

if ($datenschutz != "on") {
    array_push($fehler, "Sie müssen die Datenschutzbestimmungen akzeptieren");
}

/*
 * Speicher der Daten
 */
if (count($fehler) == 0) {
    $myfile = fopen("newsletter.csv", "a+") or die("Unable to open file!");
    fwrite($myfile, $name . ";");
    fwrite($myfile, $email . ";");
    fwrite($myfile, $lang . ";");
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
<body style="font-family: 'Comic Sans', sans-serif;">
<?php

if (count($fehler) == 0) {
    echo "<h3>Erfolgreiche Anmeldung. </h3>";
    echo $name . "<br>";
    echo $email . "<br>";
    echo "Gewünschte Sprache: " . $lang . "<br>";
    echo "Datenschutzbestimmungen akzeptiert";
} else {
    echo "<h3>Leider ist ein Fehler aufgetreten.</h3>";
    foreach ($fehler as $meldung) {
        echo $meldung . "<br>";
    }
}

// Return to index.php after 3 seconds
header("Refresh: 3; url=index.php");
?>
</body>
