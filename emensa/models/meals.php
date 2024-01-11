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
use emensa\components\MealCardComponent;
use emensa\models\Meal;

$link = mysqli_connect("localhost", "root", "root", "emensawerbeseite");

// Check if the database connection was successful
if (!$link) {
    // Display an error message and terminate the script if the connection failed
    echo "Verbindung zur Datenbank fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

/**
 * Fetches the specified number of meals randomly from the database and returns them as a PHP array.
 * @param int $n The number of meals to fetch, or -1 to fetch all meals
 * @param int|null $id The id of the meal to fetch, or null to fetch all meals
 * @return Meal[] The fetched meals
 */
function queryMeals(int $n = -1, int $id = null): array
{
    $link = mysqli_connect("localhost", "root", "root", "emensawerbeseite");

    // Define a SQL query to fetch some information from the 'gericht' table
    $query =
        "SELECT *, JSON_ARRAYAGG(code) AS allergene -- Collect all allergen codes into a JSON array

    FROM gericht
             LEFT JOIN gericht_hat_allergen
                       ON gericht.id = gericht_hat_allergen.gericht_id " . ($id != null ? "WHERE gericht.id = $id" : "") . "
    GROUP BY gericht_id ORDER BY RAND()" . ($n >= 0 ? " LIMIT $n;" : ";");

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
        $row['allergene'] = array_filter(json_decode($row['allergene'])) ?? [];
        // Return a new Meal object for each row
        return Meal::from_db($row);
    }, mysqli_fetch_all($result, MYSQLI_ASSOC));
}

/**
 * Fetches the number of meals in the database.
 * @return int The number of meals in the database
 */
function queryMealCount(): int
{
    $link = mysqli_connect("localhost", "root", "root", "emensawerbeseite");

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
 * @param Meal[] $meals The meals to fetch the allergens for
 * @return array The fetched allergens as a PHP array {code: string, name: string}[]
 */
function queryAllergensForMeals(array $meals): array
{
    $link = mysqli_connect("localhost", "root", "root", "emensawerbeseite");

    $gericht_ids = array_map(function ($meal) {
        return $meal->id;
    }, $meals);
    // Define a SQL query to fetch some information from the 'allergen' table
    $query = "
    SELECT DISTINCT allergen.code AS code, allergen.name AS name
    FROM (SELECT code FROM gericht_hat_allergen WHERE gericht_id IN (" . implode(', ', $gericht_ids) . ")) as ghac 
         INNER JOIN allergen ON ghac.code = allergen.code;";

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

/**
 * Renders all meals as HTML code.
 * @return string The HTML code to display the meals
 */
function displayMeals(int $count = 6): string
{
    if ($count < 0) throw new InvalidArgumentException("count must be >= 0");

    $gerichteDarstellen = "";

    $meals = queryMeals($count);
    foreach ($meals as $meal) {
        $gerichteDarstellen .= (new MealCardComponent($meal))->render();
    }
    $allergens = queryAllergensForMeals($meals);
    // Sort allergens by code
    usort($allergens, function ($a, $b) {
        return strcmp($a['code'], $b['code']);
    });
    $gerichteDarstellen .= "<p id='food-menu-allergens'>" . implode(array_map(function ($allergen) {
            return "<span><strong>{$allergen['code']}</strong>: {$allergen['name']}</span>";
        }, $allergens)) . "</p>";

    return $gerichteDarstellen;
}

