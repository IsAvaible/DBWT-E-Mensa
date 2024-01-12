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
@endsection

@section("content")
    <div class="content">
        <div class="profile-card">
            <img src="/img/profile_image.jpeg" alt="Benutzerbild">
            <p id="name">{{ $user['name'] . ($user['admin'] ? ' (Admin)' : '') }}</p>
            <p id="email">{{ $user['email'] }}</p>
            <a href="meine_bewertungen">Deine Bewertungen</a>
            <div>
                <label for="anzahlfehler">Anzahl Fehlversuche:</label>
                <span id="anzahlfehler">{{ $user['anzahlfehler'] }}</span>
            </div>
            <div>
                <label for="anzahlanmeldungen">Anzahl Anmeldungen:</label>
                <span id="anzahlanmeldungen">{{ $user['anzahlanmeldungen'] }}</span>
            </div>
            <div>
                <label for="letzteanmeldung">Letzte Anmeldung:</label>
                <span id="letzteanmeldung">{{ $user['letzteanmeldung'] }}</span>
            </div>
            <div>
                <label for="letzterfehler">Letzter Fehler:</label>
                <span id="letzterfehler">{{ $user['letzterfehler'] }}</span>
            </div>
            <a href="/abmeldung">
                <button type="submit">Abmelden</button>
            </a>
        </div>
    </div>
@endsection