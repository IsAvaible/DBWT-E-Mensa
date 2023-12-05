<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */

?>

@extends(".layouts.layout")

@section("content")
    <h1>Kategorien</h1>
    <ul>
        @foreach($categories as $index => $category)
            <p style="{{ $index % 2 == 0 ? 'font-weight: bold;' : '' }}">{{ $category['name'] }}</p>
        @endforeach
    </ul>
@endsection
