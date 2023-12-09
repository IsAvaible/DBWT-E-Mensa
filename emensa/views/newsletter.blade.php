<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>

@section("content")
    @if(count($errors) == 0)
        <h3>Erfolgreiche Anmeldung. </h3>
        {{ $title }} {{ $name }}<br>
        {{ $email }}<br>
    @else
        <h3>Leider ist ein Fehler aufgetreten.</h3>
        @foreach($errors as $error)
            {{ $error }}<br>
        @endforeach
    @endif
@endsection
