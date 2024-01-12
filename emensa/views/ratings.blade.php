<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>

@extends("layouts.app")

@section("cssextra")
    <link rel="stylesheet" href="css/ratings.css">
    <link rel="stylesheet" href="/css/circles.css">
@endsection

@section("content")
    <div class="circles">
        @for($i = 0; $i < 3; $i++)
            <div class="circle"></div>
        @endfor
    </div>
    <div class="content">
        <h1>Bewertungen</h1>
        <div class="ratings">
            @foreach($ratings as $rating)
                <div class="rating{{$rating['hervorgehoben'] ? ' highlighted' : ''}}">
                    <img src="img/meals/{{$rating['bildname']}}" alt="{{$rating["gerichtname"]}}">
                    <div>
                        <div class="title">
                            <div class="highlight-background"></div>
                            <h4>{{$rating["gerichtname"]}}</h4>
                        </div>
                        {!!displayRating($rating["sterne"])!!}
                        <p class="comment">"{{$rating["bemerkung"]}}"</p>
                        <p class="author">- {{$rating["benutzername"]}}</p>
                        @if ($is_admin)
                            <form action='bewertung_{{$rating['hervorgehoben'] ? 'entvorheben' : 'hervorheben'}}'
                                  method='post'>
                                <input type='hidden' name='meal_id' value='{{$rating["gerichtid"]}}'/>
                                <button type='submit'>{{$rating['hervorgehoben'] ? 'Entvorheben' : 'Hervorheben'}}</button>
                            </form>
                        @endif
                    </div>
                </div>
                @if(!$loop->last)
                    <hr/>
                @endif
            @endforeach
        </div>
    </div>
@endsection
