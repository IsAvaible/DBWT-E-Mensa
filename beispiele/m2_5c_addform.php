<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
const GET_PARAM_A = 'a';
const GET_PARAM_B = 'b';

include("m2_5a_standardparameter.php");

/**
 * Multipliziert zwei Zahlen
 * @param float|int $a Die erste Zahl
 * @param float|int $b Die zweite Zahl (optional)
 * @return float|int Das Produkt der beiden Zahlen
 */
function multiplizieren(float|int $a, float|int $b = 1): float|int
{
    return $a * $b;
}

$a = $_GET[GET_PARAM_A] ?? 0;
$b = $_GET[GET_PARAM_B] ?? 0;

$res = isset($_GET['op_mult']) ? multiplizieren($a, $b) : addieren($a, $b);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>Rechen Formular</title>
    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Open Sans, Helvetica Neue, sans-serif
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
    </style>
</head>
<body>
<h1>Rechen Formular</h1>
<form method="GET">
    <span>
        <label for="a">a:</label>
        <input type="number" name="<?php echo GET_PARAM_A ?>" id="a" value="<?php echo $a ?>">
    </span>

    <span>
        <label for="b">b:</label>
        <input type="number" name="<?php echo GET_PARAM_B ?>" id="b" value="<?php echo $b ?>">
    </span>

    <span>
        <input type="submit" name="op_add" value="Addieren">
        <input type="submit" name="op_mult" value="Multiplizieren">
    </span>

    <p>Das Ergebnis lautet <?php echo $res ?>.</p>
</form>
