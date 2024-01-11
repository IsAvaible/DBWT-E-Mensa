<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>

@extends('layouts.app')

@section('cssextra')
    <link rel="stylesheet" href="/css/rating.css">
    <link rel="stylesheet" href="/css/meal-card.css">
@endsection

@section('content')
    <div class="content">
        <h1>Speise bewerten</h1>
        <form action="/bewertung_" method="post">
            @csrf
            {!! $meal_card->render() !!}
            <div id="rating-div">
                <label for="rating">Bewertung:</label>
                <select name="rating" id="rating">
                    <option value="1" @if($rating==1) selected @endif>Schlecht</option>
                    <option value="2" @if($rating==2) selected @endif>Schlecht</option>
                    <option value="3" @if($rating==3) selected @endif>Gut</option>
                    <option value="4" @if($rating==4) selected @endif>Sehr gut</option>
                </select>
            </div>
            <div id="comment-div">
                <label for="comment">Kommentar:</label>
                <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
            </div>
            <input type="hidden" name="meal_id" value="{{ $meal->id }}">
            <button type="submit">Bewerten</button>
        </form>
    </div>
@endsection
