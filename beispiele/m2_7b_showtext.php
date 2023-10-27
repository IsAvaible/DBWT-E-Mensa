<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

const GET_PARAM_SEARCH = "search";
const TRANSLATION_FILE_PATH = "en.txt";

/**
 * Finds the translation for a given string
 * @param string $search The string to search for
 * @return string|null The translation or null if not found
 */
function findTranslation(string $search): string|null
{
    $file = fopen(TRANSLATION_FILE_PATH, "r");
    while (!feof($file)) {
        $line = fgets($file);
        $line = trim($line);
        $line = explode(";", $line);
        if ($line[0] === $search) {
            return $line[1];
        }
    }
    return null;
}

$search = $_GET[GET_PARAM_SEARCH] ?? "";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Übersetzer</title>
    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Open Sans,
            Helvetica Neue, sans-serif
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
    </style>
</head>
<body>
<h1>Übersetzer</h1>
<form method="GET">
    <span>
        <label for="search">Suche:</label>
        <input type="text" name="<?php echo GET_PARAM_SEARCH ?>" id="search" value="<?php echo $search ?>">
    </span>

    <span>
        <input type="submit" value="Suchen">
    </span>
</form>

<?php
$result = findTranslation($search);
if ($result !== null) {
    echo "<p>Übersetzung: $result</p>";
} else if (!empty($search)) {
    echo "<p>Das gesuchte Wort '{{$search}}' ist nicht enthalten.</p>";
}
?>
