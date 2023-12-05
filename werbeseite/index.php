<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

include("meals.php");
include("besucher.php");

// Count the number of newsletter signups
if (is_file("newsletter.csv")) { // Check if the file "newsletter.csv" exists
    // Open the existing file for reading
    $newsletterFile = fopen("newsletter.csv", "r");
    $newsletterSignups = 0;
    // Count the number of non-empty lines in the file
    while (!feof($newsletterFile)) {
        $line = fgets($newsletterFile);
        if (trim($line) != "") {
            $newsletterSignups++;
        }
    }
    fclose($newsletterFile);
} else {
    // If the file does not exist, create a new file for writing
    $newsletterFile = fopen("newsletter.csv", "c");
    fclose($newsletterFile);
    $newsletterSignups = 'x';
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
        <a href='wunschgericht.php'>
            <button type="submit">Wunschgericht?</button>
        </a>
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
    $n = 6; // The number of meals to display
    foreach (queryMeals($n) as $meal) {
        // Sort meal allergens by code
        usort($meal['allergens'], function ($a, $b) {
            return strcmp($a, $b);
        });
        echo "<div class='food-card'>",
            //                   <img src='img/{$meal['img']}' alt='{$meal['description']}'>
            "<div>
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
    echo "<p id='food-menu-allergens'>" . implode(array_map(function ($allergen) {
            return "<span><strong>{$allergen['code']}</strong>: {$allergen['name']}</span>";
        }, $allergens)) . "</p>";
    ?>

</div>

<h2 id="stats">E-Mensa in Zahlen</h2>
<div class="mensa-stats">
    <div><span><?php echo htmlspecialchars(queryVisitorCount()) ?? 'X' ?></span>
        <p>Besuche</p></div>
    <div><span><?php echo htmlspecialchars($newsletterSignups) ?></span>
        <p>Anmeldungen zum Newsletter</p></div>
    <div><span><?php echo htmlspecialchars(queryMealCount()) ?? 'X' ?></span>
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