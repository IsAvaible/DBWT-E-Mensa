<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>

@extends("layouts.main_layout")

@section("cssextra")
    <link rel="stylesheet" href="/css/login.css">
@endsection

@section("content")
    <div class="circles">
        @for($i = 0; $i < 3; $i++)
            @if (count($errors) > 0)
                <div class="circle error"></div>
            @else
                <div class="circle"></div>
            @endif
        @endfor
    </div>
    <div class="content">
        <h3>Anmeldung</h3>
        <div class="errors">
            @if(count($errors) > 0)
                @foreach($errors as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>
        <form action="anmeldung_verifizieren" method="post">
            <div>
                <label for="email">E-Mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Passwort:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Einloggen</button>
        </form>
    </div>
@endsection
