<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];

/**
 * Finds all years since $since in which no meal of $meals was a winner
 * @param array $meals
 * @param int $since
 * @return array All years since $since in which no meal of $meals was a winner
 */
function years_without_winners(array $meals, int $since): array
{
    $result = range($since, date('Y'));
    foreach ($meals as $number => $meal) {
        $result = array_diff($result, is_iterable($meal['winner']) ? $meal['winner'] : [$meal['winner']]);
    }
    return $result;
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>PHP Array</title>
    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Open Sans, Helvetica Neue, sans-serif
        }

        ol {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
    </style>
</head>
<body>
<h1>PHP Array</h1>
<ol>
    <?php
    foreach ($famousMeals as $number => $meal) {
        echo "<li>" . $meal['name'] . "</br>" . (is_iterable($meal['winner']) ? implode(', ', call_user_func(function (array $a) {
                rsort($a);
                return $a;
            }, $meal['winner'])) : $meal['winner']) . "</li>";
    }
    ?>
</ol>

<h2>Jahre ohne Gewinner</h2>
<p><?php echo join(', ', years_without_winners($famousMeals, 2000)) ?></p>
</body>
