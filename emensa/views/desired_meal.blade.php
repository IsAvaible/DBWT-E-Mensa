<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>

@extends("layouts.main_layout")

@section("cssextra")
    <link rel="stylesheet" href="/css/desired_meal.css">
@endsection

@section("content")
    <div>
        <h2>Haben Sie ein Wunschgericht? Teilen Sie es mit uns!</h2>
        <img id="mainImg" src="img/spaghetti.jpg" alt="Bild des Salatbuffets der Mensa">
        @if(($success ?? false))
            <p class="success">Ihr Wunschgericht wurde erfolgreich hinzugefügt!</p>
        @endif
        @if(($errors ?? []))
            <div class="errors">
                <p>Es sind Fehler aufgetreten</p>
                <ul>
                    @foreach($errors as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="wunschgericht" method="post" class="full-bleed">
            <div>
                <div>
                    <label for="name" class="error">Ihr Name:</label>
                    <input type="text" id="name" name="name">
                </div>
                <div>
                    <label for="mail">Ihre E-Mail*:</label>
                    <input type="email" id="mail" name="mail" required>
                </div>
                <div>
                    <label for="meal_name">Name des Gerichtes*:</label>
                    <input type="text" id="meal_name" name="meal_name" required>
                </div>
            </div>
            <div>
                <label for="description">Beschreibung*:</label>
            </div>
            <textarea id="description" name="description" required></textarea>
            <button type="submit">Wunsch abschicken</button>
        </form>
    </div>
@endsection
