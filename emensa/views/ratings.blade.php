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
    <div class="circles stars">
        @for($i = 0; $i < 3; $i++)
            <div class="circle"></div>
        @endfor
    </div>
    <div class="content">
        @if(count($errors) > 0)
            @foreach($errors as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        @if($success ?? false)
            <div class="alert alert-success">
                {{ $success }}
            </div>
        @endif
        <h1>@if($personal_ratings)
                Deine
            @endif Bewertungen</h1>
            <form class="filter-form" action="{{ $personal_ratings ? 'deine_bewertungen' : 'bewertungen' }}"
                  method="get">
                <select name="meal_id" id="meal_id" title="Gericht">
                    <option value="">Alle Gerichte</option>
                    @foreach($meals as $meal)
                        <option value="{{$meal->id}}"
                                @if($meal->id == $meal_id_to_filter_by) selected @endif>{{$meal->name}}</option>
                    @endforeach
                </select>
                <button type="submit">Filtern</button>
            </form>
        <div class="ratings">
            @foreach($ratings as $rating)
                <div class="rating{{$rating['hervorgehoben'] ? ' highlighted' : ''}}">
                    <img src="img/meals/{{$rating['bildname']}}" alt="{{$rating["gerichtname"]}}">
                    <div>
                        <div class="title">
                            <div class="highlight-background"></div>
                            <h4>{{$rating["gerichtname"]}}</h4>
                        </div>
                        {!!displayRating($rating["sterne"], "/bewertung?meal_id={$rating['gericht_id']}&rating=", true)!!}
                        <p class="comment">"{{$rating["bemerkung"]}}"</p>
                        <p class="author">- {{$rating["benutzername"]}}</p>
                        <div class="button-row">
                            @if ($is_admin)
                                <form action='bewertung_{{$rating['hervorgehoben'] ? 'entvorheben' : 'hervorheben'}}'
                                      method='post'>
                                    @csrf
                                    <input type='hidden' name='meal_id' value='{{$rating["gericht_id"]}}'/>
                                    <input type='hidden' name='user_id' value='{{$rating["benutzer_id"]}}'/>
                                    <input type='hidden' name='redirect_url' value='{{$_SERVER['REQUEST_URI']}}'/>
                                    <button type='submit'
                                            title="{{$rating['hervorgehoben'] ? 'Hervorhebung Entfernen' : 'Hervorheben'}}">
                                        <img src="/icons/{{$rating['hervorgehoben'] ? 'star_filled' : 'star_outline'}}.svg"
                                             alt="star_icon">
                                    </button>
                                </form>
                            @endif
                            @if ($personal_ratings)
                                <a href="/bewertung?meal_id={{$rating['gericht_id']}}">
                                    <button type="submit" class="edit-button" title="Bearbeiten">
                                        <img src="icons/pen.svg" alt="edit_icon">
                                    </button>
                                </a>
                            @endif
                            @if ($personal_ratings || $is_admin)
                                <form action='bewertung_loeschen' method='post'>
                                    @csrf
                                    <input type='hidden' name='meal_id' value='{{$rating["gericht_id"]}}'/>
                                    <input type='hidden' name='user_id' value='{{$rating["benutzer_id"]}}'/>
                                    <input type='hidden' name='redirect_url' value='{{$_SERVER['REQUEST_URI']}}'/>
                                    <button type='submit' class="delete-button" title="Löschen">
                                        <img src="icons/trash_can.svg" alt="trash_icon">
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                @if(!$loop->last)
                    <hr/>
                @endif
            @endforeach
            @if(count($ratings) == 0)
                <div class="alert alert-info">
                    Keine Bewertungen vorhanden.
                    <a href="/bewertung?meal_id={{$meal_id_to_filter_by}}&rating=4">Jetzt Bewerten</a>
                </div>
            @endif
        </div>
    </div>
@endsection
