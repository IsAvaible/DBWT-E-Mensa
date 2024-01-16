<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>

@extends("layouts.app")

@section("cssextra")
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/circles.css">
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
            @if($redirect_reason)
                <div class="alert alert-warning">
                    {{ $redirect_reason }}
                </div>
            @endif
            @if(count($errors) > 0)
                @foreach($errors as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>
        <form action="anmeldung_verifizieren" method="post">
            @csrf
            <div>
                <label for="email">E-Mail:</label>
                <input type="email" id="email" name="email" autocomplete="email" required>
            </div>
            <div>
                <label for="password">Passwort:</label>
                <input type="password" id="password" name="password" autocomplete="current-password" required>
            </div>
            <input type="hidden" name="redirect_reason" value="{{ $redirect_reason }}">
            <input type="hidden" name="redirect_url" value="{{ $redirect_url }}">
            <button type="submit">Einloggen</button>
        </form>
    </div>
@endsection
