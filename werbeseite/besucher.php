<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
/*
 * This file is used to log the IP addresses of visitors to the site and to count the number of visitors.
 */

// Establish a new database connection to the MySQL database server
$link = mysqli_connect("localhost", "root", "root", "emensawerbeseite");

// Check if the database connection was successful
if (!$link) {
    // Display an error message and terminate the script if the connection failed
    echo "Verbindung zur Datenbank fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$IP = $_SERVER['REMOTE_ADDR'];
// Create a new entry in the 'besucher' table if the IP address wasn't already logged today
if (mysqli_num_rows(mysqli_query($link, "SELECT * FROM besucher WHERE IP = '{$IP}' AND datum = '" . date('Ymd') . "'")) == 0) {
    mysqli_query($link, "INSERT INTO besucher (ip) VALUES ('$IP')");
}

/**
 * Returns the number of visitors to the site.
 * @return int The number of visitors
 */
function queryVisitorCount(): int
{
    global $link;

    $result = mysqli_query($link, "SELECT COUNT(*) FROM besucher");

    // Check if the query execution was successful
    if (!$result) {
        // Display an error message and terminate the script if the query execution failed
        echo "Fehler während der Besucher Datenbankabfrage:  ", mysqli_error($link);
        return -1;
    }

    return mysqli_fetch_row($result)[0];
}


