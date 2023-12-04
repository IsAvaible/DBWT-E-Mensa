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
</head>
<header class="full-bleed">
    <img src="img/logo.png" alt="E-Mensa Logo">
    <nav>
        <a href="wunschgericht#announcements">Ankündigungen</a>
        <a href='wunschgericht#menu'>Speisen</a>
        <a href='wunschgericht#stats'>Zahlen</a>
        <a href='wunschgericht#contact'>
            <Kon></Kon>
            takt</a>
        <a href='wunschgericht#important'>Wichtig für uns</a>
    </nav>
</header>

<body>

<h2 id="contact">Haben Sie ein Wunschgericht? Teilen Sie es mit uns!</h2>
<form class="newsletter" action="wunschgerichtbackend.php" method="post">
    <div>
        <div>
            <label for="name">Ihr Name:</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <label for="mail">Ihre E-Mail*:</label>
            <input type="email" id="mail" name="mail" required>
        </div>
    </div>
    <div>
        <div>
            <label for="gerichtname">Name des Gerichtes*:</label>
            <input type="text" id="gerichtname" name="gerichtname" required>
        </div>
    </div>
    <div>
        <div>
            <label for="beschreibung">Beschreibung*:</label>
            <input type="text" id="beschreibung" name="beschreibung" style="height:150px;" required>
        </div>
    </div>
    <button type="submit">Wunsch abschicken</button>
</form>
</body>