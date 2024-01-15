<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>

@extends("layouts.app")

@section("cssextra")
    <link rel="stylesheet" href="/css/desired_meal.css">
    <link rel="stylesheet" href="/css/circles.css">
@endsection

@section("content")
    <div class="circles">
        @for($i = 0; $i < 3; $i++)
            @if (count($errors ?? []) > 0)
                <div class="circle error"></div>
            @else
                <div class="circle"></div>
            @endif
        @endfor
    </div>
    <div class="content">
        <h2>Hast du ein Wunschgericht? Teile es mit uns!</h2>
        <img id="mainImg" src="img/meals/00_image_missing.jpeg" alt="Bild des Salatbuffets der Mensa">
        @if(count($errors ?? []) > 0)
            @foreach($errors as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <form action="wunschgericht" method="post" class="full-bleed desired-meal-form">
            @csrf
            <div>
                <div>
                    <label for="name" class="error">Dein Name:</label>
                    <input type="text" id="name" name="name" value="{{$name}}">
                </div>
                <div>
                    <label for="mail">Deine E-Mail*:</label>
                    <input type="email" id="mail" name="mail" value="{{$mail}}" required>
                </div>
                <div>
                    <label for="meal_name">Name des Gerichtes*:</label>
                    <input type="text" id="meal_name" name="meal_name" value="{{$meal_name}}" required>
                </div>
            </div>
            <div>
                <label for="description">Beschreibung*:</label>
            </div>
            <textarea id="description" name="description" required></textarea>
            <button type="submit">Wunsch abschicken</button>
        </form>
        @if(($success ?? false))
            <div class="alert alert-success">
                Dein Wunschgericht wurde erfolgreich eingereicht!
            </div>
        @endif
    </div>
@endsection
