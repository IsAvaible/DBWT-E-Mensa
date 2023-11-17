<?php
// Establish a new database connection to the MySQL database server
$link = mysqli_connect("localhost", "root", "root", "emensawerbeseite");

// Check if the database connection was successful
if (!$link) {
    // Display an error message and terminate the script if the connection failed
    echo "Verbindung zur Datenbank fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

// Define a SQL query to fetch some information from the 'gericht' table
$query =
    "SELECT gericht.name  AS name,
       beschreibung  AS description,
       vegetarisch   AS vegeterian,
       vegan,
       preisintern   AS price_intern,
       preisextern   AS price_extern,
       JSON_ARRAYAGG(code) AS allergens -- Collect all allergen codes into a JSON array
    FROM gericht
             LEFT JOIN gericht_hat_allergen
                       ON gericht.id = gericht_hat_allergen.gericht_id
    GROUP BY gericht_id LIMIT 5;";

// Execute the SQL query
$result = mysqli_query($link, $query);

// Check if the query execution was successful
if (!$result) {
    // Display an error message and terminate the script if the query execution failed
    echo "Fehler während der Gerichte Datenbankabfrage:  ", mysqli_error($link);
    exit();
}

// Fetch all the rows from the result set and transform each row
$meals = array_map(function ($row) {
    // Transform the 'allergens' field from JSON format into a PHP array
    $row['allergens'] = array_filter(json_decode($row['allergens'])) ?? [];
    return $row;
}, mysqli_fetch_all($result, MYSQLI_ASSOC));

// Define a SQL query to fetch some information from the 'allergen' table
$query = "
    SELECT DISTINCT allergen.code AS code, allergen.name AS name
    FROM (SELECT id FROM gericht LIMIT 5) AS gericht
         LEFT JOIN gericht_hat_allergen
                   ON gericht.id = gericht_hat_allergen.gericht_id
         INNER JOIN allergen
                    ON gericht_hat_allergen.code = allergen.code;";

// Execute the SQL query
$result = mysqli_query($link, $query);

// Check if the query execution was successful
if (!$result) {
    // Display an error message and terminate the script if the query execution failed
    echo "Fehler während der Allergene Datenbankabfrage:  ", mysqli_error($link);
    exit();
}

// Fetch all the rows from the result set into a PHP array
$allergens = mysqli_fetch_all($result, MYSQLI_ASSOC);
