<?php
$link = mysqli_connect("localhost", // Host der Datenbank
    "root",                 // Benutzername zur Anmeldung
    "root",    // Passwort
    "emensawerbeseite"      // Auswahl der Datenbanken (bzw. des Schemas)
// optional port der Datenbank
);

if (!$link) {
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$sql = "SELECT id, name, beschreibung FROM gericht";
echo $sql;
echo "<br><br>";

echo "<style>
table, th, td {
 border: 1px solid black;
 border-collapse: collapse;
}
</style>";

$result = mysqli_query($link, $sql);
if (!$result) {
    echo "Fehler während der Abfrage:  ", mysqli_error($link);
    exit();
}

echo "<table>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

mysqli_free_result($result);
mysqli_close($link);