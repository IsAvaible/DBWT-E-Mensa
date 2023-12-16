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
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1"/>
    <title>E-Mensa</title>
    <link rel="stylesheet" href="/css/preflight.css">
    <link rel="stylesheet" href="/css/index.css">
    @yield("cssextra")
</head>

<body class="base-layout">
@section("header")
    <header class="full-bleed">
        <a class="logo" href="/" title="Startseite"><img src="/img/logo.png" alt="E-Mensa Logo"></a>
        <nav>
            <a href="/#announcements">Ankündigungen</a>
            <a href='/#menu'>Speisen</a>
            <a href='/#stats'>Zahlen</a>
            <a href='/#contact'>Kontakt</a>
            <a href='/#important'>Wichtig für uns</a>
            <a href='wunschgericht'>
                Wunschgericht
            </a>
        </nav>
        @if (isset($_SESSION['user']["name"]))
            <a class="user" href="profil">
                <img src="/icons/user.svg" alt="Benutzerbild">
                <span>{{$_SESSION['user']["name"]}}</span>
            </a>
        @else
            <a class="user" href="anmeldung">
                <img src="/icons/user.svg" alt="Benutzerbild">
                <span>Anmelden &crarr;</span>
            </a>
        @endif
        <div id="overlay">
            <div>
                <nav>
                    <a href="/#announcements">Ankündigungen</a>
                    <a href='/#menu'>Speisen</a>
                    <a href='/#stats'>Zahlen</a>
                    <a href='/#contact'>Kontakt</a>
                    <a href='/#important'>Wichtig für uns</a>
                    <a href='wunschgericht'>
                        Wunschgericht
                    </a>
                    @if (isset($_SESSION['user']["name"]))
                        <a href="profil">
                            Profil: {{$_SESSION['user']["name"]}}
                        </a>
                    @else
                        <a href="anmeldung">
                            Anmelden
                        </a>
                    @endif
                </nav>
            </div>
        </div>
        <button id="menu" type="submit">≡</button>
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

<script>
    let hamburger = document.querySelector('#menu');
    let overlay = document.querySelector('#overlay');

    hamburger.addEventListener('click', function () {
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', function () {
        overlay.classList.remove('active');
    });
</script>
@yield("jsextra")
</body>
