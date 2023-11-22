<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
/*
 * This file is used to load the meals from the database and to count the number of meals.
 */

// Establish a new database connection to the MySQL database server
$link = mysqli_connect("localhost", "root", "root", "emensawerbeseite");

// Check if the database connection was successful
if (!$link) {
    // Display an error message and terminate the script if the connection failed
    echo "Verbindung zur Datenbank fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

/**
 * Fetches the specified number of meals from the database and returns them as a PHP array.
 * @param int $n The number of meals to fetch, or -1 to fetch all meals
 * @return array The fetched meals {name: string, description: string, vegetarian: bool, vegan: bool, price_intern: float, price_extern: float, allergens: string[]}
 */
function queryMeals(int $n = -1): array
{
    global $link;

    // Define a SQL query to fetch some information from the 'gericht' table
    $query =
        "SELECT gericht.name  AS name,
       beschreibung  AS description,
       vegetarisch   AS vegetarian,
       vegan,
       preisintern   AS price_intern,
       preisextern   AS price_extern,
       JSON_ARRAYAGG(code) AS allergens -- Collect all allergen codes into a JSON array
    FROM gericht
             LEFT JOIN gericht_hat_allergen
                       ON gericht.id = gericht_hat_allergen.gericht_id
    GROUP BY gericht_id" . ($n >= 0 ? " LIMIT $n;" : ";");

    // Execute the SQL query
    $result = mysqli_query($link, $query);

    // Check if the query execution was successful
    if (!$result) {
        // Display an error message and terminate the script if the query execution failed
        echo "Fehler während der Gerichte Datenbankabfrage:  ", mysqli_error($link);
        return [];
    }

    // Fetch all the rows from the result set and transform each row
    return array_map(function ($row) {
        // Transform the 'allergens' field from JSON format into a PHP array
        $row['allergens'] = array_filter(json_decode($row['allergens'])) ?? [];
        return $row;
    }, mysqli_fetch_all($result, MYSQLI_ASSOC));
}

/**
 * Fetches the number of meals in the database.
 * @return int The number of meals in the database
 */
function queryMealCount(): int
{
    global $link;

    // Query the number of meals and exit if the query execution failed
    if (!$result = mysqli_query($link, "SELECT COUNT(*) FROM gericht;")) {
        // Display an error message and terminate the script if the query execution failed
        echo "Fehler während der Allergene Datenbankabfrage:  ", mysqli_error($link);
        return -1;
    }

    return mysqli_fetch_row($result)[0];
}


/**
 * Fetches all allergens used in the first $n meals
 * @param int $n The number of meals to fetch the allergens for, or -1 for all meals
 * @return array The fetched allergens as a PHP array {code: string, name: string}[]
 */
function queryAllergens(int $n = -1): array
{
    global $link;

    // Define a SQL query to fetch some information from the 'allergen' table
    $query = "
    SELECT DISTINCT allergen.code AS code, allergen.name AS name
    FROM (SELECT id FROM gericht" . ($n >= 0 ? " LIMIT $n" : "") . ") AS gericht
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
        return [];
    }

    // Fetch all the rows from the result set into a PHP array
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

