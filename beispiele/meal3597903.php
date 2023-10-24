<?php
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_SHOW_DESCRIPTION = 'show_description';
const GET_PARAM_LANG = 'lang';
const GET_PARAM_RATING_SORT = 'rating_sort';

/**
 * Translations for all languages.
 */
$trans = [
    'de' => [
        'lang_de' => 'Deutsch',
        'lang_en' => 'Englisch',
        'meal_name' => 'Gericht',
        'meal_price' => 'Preis',
        'allergens' => 'Allergene',
        'ratings' => 'Bewertungen',
        'search_filter' => 'Filter',
        'search_submit' => 'Suchen',
        'rating' => 'Bewertung',
        'rating_sort' => 'Sortierung',
        'rating_total' => 'Insgesamt',
        'rating_author' => 'Autor',
        'rating_text' => 'Text',
        'rating_stars' => 'Sterne'
    ],
    'en' => [
        'lang_de' => 'German',
        'lang_en' => 'English',
        'meal_name' => 'Meal',
        'meal_price' => 'Price',
        'allergens' => 'Allergens',
        'ratings' => 'Ratings',
        'search_filter' => 'Filter',
        'search_submit' => 'Search',
        'rating' => 'Rating',
        'rating_sort' => 'Sort',
        'rating_total' => 'Total',
        'rating_author' => 'Author',
        'rating_text' => 'Text',
        'rating_stars' => 'Stars'
    ]
][$selectedLang = $_GET[GET_PARAM_LANG] ?? 'de'];

/**
 * List of all allergens.
 */
$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch'
];

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42             // Number of available meals
];

$ratings = [
    ['text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2],
    ['text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4],
    ['text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4],
    ['text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3]
];

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])) {
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (str_contains(strtolower($rating['text']), strtolower($searchTerm))) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}
if (($_GET[GET_PARAM_RATING_SORT] ?? 'TOP') === 'TOP') {
    usort($showRatings, function ($a, $b) {
        return $b['stars'] <=> $a['stars'];
    });
} else {
    usort($showRatings, function ($a, $b) {
        return $a['stars'] <=> $b['stars'];
    });
}

function calcMeanStars(array $ratings): float
{
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
    }
    return $sum;
}

?>
<!DOCTYPE html>
<html lang="<?php echo $selectedLang ?>">
<head>
    <meta charset="UTF-8"/>
    <title><?php echo $trans['meal_name'] ?>: <?php echo $meal['name']; ?></title>
    <style>
        * {
            font-family: Arial, serif;
        }

        nav {
            display: flex;
            justify-content: flex-end;
            gap: 0 0.5rem;
        }

        .rating {
            color: #575757;
        }

        #meal_allergens > p {
            font-weight: bolder;
        }

        #meal_allergens > ul {
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #meal_allergens > ul > li:not(:first-child):before {
            content: ', ';
        }
    </style>
</head>
<body>
<nav>
    <form>
        <a href="?<?php echo http_build_query($_GET) . "&" . GET_PARAM_LANG; ?>=de">Deutsch</a>
        <a href="?<?php echo http_build_query($_GET) . "&" . GET_PARAM_LANG; ?>=en">Englisch</a>
    </form>
</nav>
<h1><?php echo $trans['meal_name'] ?>: <?php echo $meal['name']; ?></h1>
<?php
if (($_GET[GET_PARAM_SHOW_DESCRIPTION] ?? 1) != 0) {
    echo '<p>' . $meal['description'] . '</p>';
}
?>
<p id="meal_price">
    <?php echo $trans['meal_price'] ?>:
    <?php echo number_format($meal['price_intern'], 2) . '€' ?> (intern)
    <?php echo number_format($meal['price_extern'], 2) . '€' ?> (extern)
</p>
<div id="meal_allergens">
    <p><?php echo $trans['allergens'] ?>:</p>
    <ul>
        <?php
        foreach ($allergens as $allergenId => $allergen) {
            echo '<li>' . $allergen . ' (' . $allergenId . ')' . '</li>';
        }
        ?>
    </ul>
</div>
<h1><?php echo $trans['rating'] ?> (<?php echo $trans['rating_total'] ?>: <?php echo calcMeanStars($ratings); ?>)</h1>
<form method="get">
    <label for="rating_sort"><?php echo $trans['rating_sort'] ?>:</label>
    <select id="rating_sort" name="rating_sort">
        <option value="TOP" <?php if (($_GET[GET_PARAM_RATING_SORT] ?? 'TOP') == 'TOP') {
            echo 'selected';
        } ?>>Top
        </option>
        <option value="FLOP" <?php if (($_GET[GET_PARAM_RATING_SORT] ?? 'TOP') == 'FLOP') {
            echo 'selected';
        } ?>>Flop
        </option>
    </select>
    <label for="search_text"><?php echo $trans['search_filter'] ?>:</label>
    <input id="search_text" type="text" name="search_text" value="<?php echo $_GET['search_text'] ?? '' ?>">
    <input type="submit" value="<?php echo $trans['search_submit'] ?>">
</form>
<table class="rating">
    <thead>
    <tr>
        <td><?php echo $trans['rating_author'] ?></td>
        <td><?php echo $trans['rating_text'] ?></td>
        <td><?php echo $trans['rating_stars'] ?></td>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($showRatings as $rating) {
        echo "<tr>
                      <td class='rating_author'>{$rating['author']}</td>
                      <td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars' style='display: flex'>";
        for ($i = 0; $i < $rating['stars']; $i++) {
            echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1rem; height: 1rem">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                </svg>';
        }
        echo "</td></tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>