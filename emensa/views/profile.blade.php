<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>
@extends("layouts.app")

@section("cssextra")
    <link rel="stylesheet" href="/css/profile.css">
    <link rel="stylesheet" href="/css/circles.css">
@endsection

@section("content")
    <div class="circles">
        @for($i = 0; $i < 3; $i++)
            <div class="circle"></div>
        @endfor
    </div>
    <div class="content">
        <div class="profile-card">
            <img src="/img/profile_image.jpeg" alt="Benutzerbild">
            <p id="name">{{ $user['name'] . ($user['admin'] ? ' (Admin)' : '') }}</p>
            <p id="email">{{ $user['email'] }}</p>
            <a href="deine_bewertungen">Deine Bewertungen</a>
            <div>
                <p>Anzahl Fehlversuche:</p>
                <span id="anzahlfehler">{{ $user['anzahlfehler'] }}</span>
            </div>
            <div>
                <p>Anzahl Anmeldungen:</p>
                <span id="anzahlanmeldungen">{{ $user['anzahlanmeldungen'] }}</span>
            </div>
            <div>
                <p>Letzte Anmeldung:</p>
                <span id="letzteanmeldung">{{ $user['letzteanmeldung'] }}</span>
            </div>
            <div>
                <p>Letzter Fehler:</p>
                <span id="letzterfehler">{{ $user['letzterfehler'] }}</span>
            </div>
            <a href="/abmeldung">
                <button type="submit">Abmelden</button>
            </a>
        </div>
    </div>
@endsection