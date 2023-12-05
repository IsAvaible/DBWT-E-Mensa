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
