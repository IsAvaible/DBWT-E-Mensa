<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all()
{
    try {
        $link = connectdb();

        $sql = 'SELECT id, name, preisintern, preisextern, vegetarisch, vegan, beschreibung, erfasst_am FROM gericht ORDER BY name ASC';
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    } catch (Exception $ex) {
        $data = array(
            'id' => '-1',
            'error' => true,
            'name' => 'Datenbankfehler ' . $ex->getCode(),
            'beschreibung' => $ex->getMessage());
    } finally {
        return $data;
    }
}

function gerichte_dartsellen()
{
    //Gerichte dastellen
    $gerichteDarstellen = "";

    $n = 6; // The number of meals to display
    foreach (queryMeals($n) as $meal) {
        // Sort meal allergens by code
        usort($meal['allergens'], function ($a, $b) {
            return strcmp($a, $b);
        });
        $gerichteDarstellen .= "<div class='food-card'>
                <div>
                            <h3>{$meal['name']}</h3>
                            <p>{$meal['description']}</p>
                            <div class='food-properties'>
                                <p><strong>Preis</strong>: " . number_format($meal['price_intern'], 2) . "€ (intern) / " . number_format($meal['price_extern'], 2) . "€ (extern)</p>
                                <p><strong>Allergene</strong>: " . implode(', ', $meal['allergens']) . "</p>" .
            ($meal['vegan'] ? '<img src="icons/vegan.svg" alt="Vegan"/>'
                : ($meal['vegetarian'] ? '<img src="icons/vegetarian.svg" alt="Vegetarisch"/>' : "")) . "
                            </div>
                        </div>
                    </div>";
    }
    $allergens = queryAllergens($n);
    // Sort allergens by code
    usort($allergens, function ($a, $b) {
        return strcmp($a['code'], $b['code']);
    });
    $gerichteDarstellen .= "<p id='food-menu-allergens'>" . implode(array_map(function ($allergen) {
            return "<span><strong>{$allergen['code']}</strong>: {$allergen['name']}</span>";
        }, $allergens)) . "</p>";

    return $gerichteDarstellen;
}


