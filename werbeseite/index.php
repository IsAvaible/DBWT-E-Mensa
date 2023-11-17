<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

include("meals.php");
include("besucher.php");

/*
 * Newsletter Anmeldungen
 */

if (is_file("newsletter.csv")) {
    $fnewsletteranmeldung = fopen("newsletter.csv", "r");
    $newsletteranmeldung = 0;
    while (!feof($fnewsletteranmeldung)) {
        $line = fgets($fnewsletteranmeldung);
        if (trim($line) != "") {
            $newsletteranmeldung++;
        }
    }
    fclose($fnewsletteranmeldung);
} else {
    $fnewsletteranmeldung = fopen("newsletter.csv", "c");
    fclose($fnewsletteranmeldung);
    $newsletteranmeldung = 'x';
}

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>E-Mensa</title>
    <link rel="stylesheet" href="preflight.css">
    <link rel="stylesheet" href="index.css">
</head>
<body class="base-layout">

<header class="full-bleed">
    <img src="img/logo.png" alt="E-Mensa Logo">
    <nav>
        <a href="#announcements">Ankündigungen</a>
        <a href='#menu'>Speisen</a>
        <a href='#stats'>Zahlen</a>
        <a href='#contact'>Kontakt</a>
        <a href='#important'>Wichtig für uns</a>
    </nav>
</header>
<div id="intro">
    <img src="img/salad.jpg" alt="Bild des Salatbuffets der Mensa">
    <h2 id="announcements">Willkommen auf der E-Mensa!</h2>
    <div id="description">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur cupiditate delectus dolor esse eum fuga
        ipsam, minima molestiae quam rerum, ut velit vero! A alias amet animi autem commodi debitis, doloribus ea earum
        illum natus necessitatibus, perferendis placeat quae quasi vero, vitae voluptate voluptatibus. Ducimus et
        eveniet,
        expedita facilis ipsum quae voluptas. Amet assumenda deserunt ea eaque eveniet illo inventore, magni nisi nulla,
        pariatur, quia quisquam ratione veritatis. Asperiores at, beatae blanditiis eius facere illo ipsam ipsum modi
        mollitia neque numquam odio perferendis quae quam quas voluptatem voluptatibus! Blanditiis eos illo inventore
        necessitatibus nostrum obcaecati possimus quod quos ratione!
    </div>
</div>
<h2 id="menu">Köstlichkeiten die Sie erwarten</h2>
<div class="food-menu full-bleed">
    <?php
    if (isset($meals) && isset($allergens)) { // meals.php included
        foreach ($meals as $meal) {
            // Sort meal allergens by code
            usort($meal['allergens'], function ($a, $b) {
                return strcmp($a, $b);
            });
            echo "<div class='food-card'>",
//                    <img src='img/{$meal['img']}' alt='{$meal['description']}'>
                "<div>
                        <h3>{$meal['name']}</h3>
                        <p>{$meal['description']}</p>
                        <div class='food-properties'>
                            <p><strong>Preis</strong>: " . number_format($meal['price_intern'], 2) . "€ (intern) / " . number_format($meal['price_extern'], 2) . "€ (extern)</p>
                            <p><strong>Allergene</strong>: " . implode(', ', $meal['allergens']) . "</p>
                        </div>
                    </div>
                </div>";
        }
        // Sort allergens by code
        usort($allergens, function ($a, $b) {
            return strcmp($a['code'], $b['code']);
        });
        echo "<p id='food-menu-allergens'>" . implode(array_map(function ($allergen) {
                return "<span><strong>{$allergen['code']}</strong>: {$allergen['name']}</span>";
            }, $allergens)) . "</p>";
    }
    ?>

</div>

<h2 id="stats">E-Mensa in Zahlen</h2>
<div class="mensa-stats">
    <div><span><?php echo $besucheranzahl ?? 'X' ?></span>
        <p>Besuche</p></div>
    <div><span><?php echo $newsletteranmeldung ?></span>
        <p>Anmeldungen zum Newsletter</p></div>
    <div><span><?php echo $meal_count ?? 'X' ?></span>
        <p>Speisen</p></div>
</div>

<h2 id="contact">Interesse geweckt? Wir informieren Sie!</h2>
<form class="newsletter" action="newsletterbackend.php" method="post">
    <div>
        <div>
            <label for="name">Ihr Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="mail">Ihre E-Mail:</label>
            <input type="email" id="mail" name="mail" required>
        </div>
        <div>
            <label for="lang">Newsletter bitte in:</label>
            <select id="lang" name="lang">
                <option value="de">Deutsch</option>
                <option value="en">Englisch</option>
            </select>
        </div>
    </div>
    <div>
        <input type="checkbox" id="datenschutz" name="datenschutz" required>
        <label for="datenschutz">Den Datenschutzbestimmungens stimme ich zu</label>
    </div>
    <button type="submit">Zum Newsletter anmelden</button>
</form>

<h2 id="important">Das ist uns wichtig</h2>
<div class="important-to-us">
    <ul>
        <li>Beste frische saisonale Zutaten</li>
        <li>Ausgewogene abwechslungsreiche Gerichte</li>
        <li>Sauberkeit</li>
    </ul>
</div>

<h2 style="text-align: center">Wir freuen uns auf ihren Besuch!</h2>

<footer class="full-bleed">
    <ul>
        <li>&copy; E-Mensa GmbH</li>
        <li>Henning Schreiber & Simon Conrad</li>
        <li><a href="">Impressum</a></li>
    </ul>
</footer>
</body>
</html>