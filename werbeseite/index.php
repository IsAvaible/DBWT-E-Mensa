<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

include("meals.php");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
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
<div class="carousel">
    <img src="img/salad.jpg" alt="Bild des Salatbuffets der Mensa">
</div>
<h2 id="announcements">Bald gibt es Essen auch online ;)</h2>
<div class="description">
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur cupiditate delectus dolor esse eum fuga
    ipsam, minima molestiae quam rerum, ut velit vero! A alias amet animi autem commodi debitis, doloribus ea earum
    illum natus necessitatibus, perferendis placeat quae quasi vero, vitae voluptate voluptatibus. Ducimus et eveniet,
    expedita facilis ipsum quae voluptas. Amet assumenda deserunt ea eaque eveniet illo inventore, magni nisi nulla,
    pariatur, quia quisquam ratione veritatis. Asperiores at, beatae blanditiis eius facere illo ipsam ipsum modi
    mollitia neque numquam odio perferendis quae quam quas voluptatem voluptatibus! Blanditiis eos illo inventore
    necessitatibus nostrum obcaecati possimus quod quos ratione!
</div>
<h2 id="menu">Köstlichkeiten die sie erwarten</h2>
<table class="food-menu">
    <thead>
    <tr>
        <td>Beschreibung</td>
        <td>Preis intern</td>
        <td>Preis extern</td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?php
    if (isset($meals)) { // meals.php included
        foreach ($meals as $meal) {
            echo "<tr><td>{$meal['description']}</td>
                          <td>" . number_format($meal['price_intern'], 2) . "</td>
                          <td>" . number_format($meal['price_extern'], 2) . "</td>
                          <td><img src='img/{$meal['img']}' alt='{$meal['description']}'></td>
                      </tr>";
        }
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <td style="text-align: center" colspan="4">Alle Preise in Euro</td>
    </tr>
    </tfoot>
</table>

<h2 id="stats">E-Mensa in Zahlen</h2>
<div class="mensa-stats">
    <p>x Besuche</p>
    <p>y Anmeldungen zum Newsletter</p>
    <p>z Speisen</p>
</div>

<h2 id="contact">Interesse geweckt? Wir informieren Sie!</h2>
<form class="newsletter" action="" method="post">
    <div>
        <div>
            <label for="name">Ihr Name:</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="mail">Ihre E-Mail:</label>
            <input type="email" id="mail" name="mail">
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
        <input type="checkbox" id="datenschutz" name="datenschutz">
        <label for="datenschutz">Den Datenschutzbestimmungens stimme ich zu</label>
        <button type="submit" disabled>Zum Newsletter anmelden</button>
    </div>
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