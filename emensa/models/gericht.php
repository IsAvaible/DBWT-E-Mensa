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
            ($meal['vegan'] ? '<span title="Vegan"><svg width="24px" height="24px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M14.5 11.5C12.75 13.3824 11 18 11 18C11 18 8.5 11.5 6 10" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M18.0155 7.73006L18.3121 10.81C18.5045 12.8081 17.0064 14.5871 15.0083 14.7795C13.0478 14.9683 11.2718 13.5352 11.083 11.5747C10.8942 9.61421 12.3305 7.87187 14.291 7.68309L17.5749 7.36689C17.7969 7.34552 17.9941 7.50812 18.0155 7.73006Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>'
                : ($meal['vegetarian'] ? '<span title="Vegetarisch"><svg width="24px" height="24px" viewBox="0 0 24 24" stroke-width="1.5" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M7 21C7 21 7.5 16.5 11 12.5" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M19.1297 4.24224L19.7243 10.4167C20.0984 14.3026 17.1849 17.7626 13.2989 18.1367C9.486 18.5039 6.03191 15.7168 5.66477 11.9039C5.29763 8.09099 8.09098 4.70237 11.9039 4.33523L18.475 3.70251C18.8048 3.67074 19.098 3.91239 19.1297 4.24224Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></span>' : "")) . "
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


