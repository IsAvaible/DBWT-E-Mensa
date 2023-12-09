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
    <title>E-Mensa</title>
    <link rel="stylesheet" href="/css/preflight.css">
    <link rel="stylesheet" href="/css/index.css">
    @yield("cssextra")
</head>

<body class="base-layout">
@section("header")
    <header class="full-bleed">
        <a href="/" title="Startseite"><img src="/img/logo.png" alt="E-Mensa Logo"></a>
        <nav>
            <a href="/#announcements">Ankündigungen</a>
            <a href='/#menu'>Speisen</a>
            <a href='/#stats'>Zahlen</a>
            <a href='/#contact'>Kontakt</a>
            <a href='/#important'>Wichtig für uns</a>
            <a href='wunschgericht'>
                <button type="submit">Wunschgericht?</button>
            </a>
        </nav>
    </header>
@show

@yield("content")

@section("footer")
    <footer class="full-bleed">
        <ul>
            <li>&copy; E-Mensa GmbH</li>
            <li>Henning Schreiber & Simon Conrad</li>
            <li><a href="">Impressum</a></li>
        </ul>
    </footer>
@show

@yield("jsextra")
</body>
