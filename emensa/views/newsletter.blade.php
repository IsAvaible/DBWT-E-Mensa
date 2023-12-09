<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>
@extends("layouts.main_layout")
@section("cssextra")
    <link rel="stylesheet" href="/css/newsletter.css">
@endsection

@section("content")
    <div>
    @if(count($errors) == 0)
            <h3>Erfolgreiche Anmeldung!</h3>
            <p>{{ $name }}</p>
            <p>{{ $email }}</p>
    @else
        <h3>Leider ist ein Fehler aufgetreten.</h3>
        @foreach($errors as $error)
                <p class="error">{{ $error }}</p>
        @endforeach
    @endif
    </div>
@endsection
