<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Wunschgericht</title>
    <link rel="stylesheet" href="preflight.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="wunschgericht.css">
</head>
<header class="full-bleed">
    <img src="img/logo.png" alt="E-Mensa Logo">
    <nav>
        <a href="/#announcements">Ankündigungen</a>
        <a href='/#menu'>Speisen</a>
        <a href='/#stats'>Zahlen</a>
        <a href='/#contact'>Kontakt</a>
        <a href='/#important'>Wichtig für uns</a>
    </nav>
</header>

<body class="base-layout">
<h2 id="contact">Haben Sie ein Wunschgericht? Teilen Sie es mit uns!</h2>
<img id="mainImg" src="img/spaghetti.jpg" alt="Bild des Salatbuffets der Mensa">
<form action="add_desired_meal" method="post" class="full-bleed">
    <div>
        <div>
            <label for="name">Ihr Name:</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="mail">Ihre E-Mail*:</label>
            <input type="email" id="mail" name="mail" required>
        </div>
        <div>
            <label for="meal_name">Name des Gerichtes*:</label>
            <input type="text" id="meal_name" name="gerichtname" required>
        </div>
    </div>
        <div>
            <label for="description">Beschreibung*:</label>
        </div>
    <textarea id="description" name="beschreibung" required></textarea>
    <button type="submit">Wunsch abschicken</button>
</form>
</body>