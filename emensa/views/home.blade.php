<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>
@extends("layouts.app")

@section("content")
    <div id="intro">
        <img src="/img/salad.jpg" alt="Bild des Salatbuffets der Mensa">
        @if(count($alerts) > 0)
            <div class="alerts">
                @foreach($alerts as $alert)
                    <div class="alert alert-{{$alert['type']}}">
                        {{ $alert['message'] }}
                    </div>
                @endforeach
            </div>
        @endif
        <h2 id="announcements">Willkommen auf der E-Mensa!</h2>
        <div id="description">
            Willkommen auf der E-Mensa Aachen, dem Ort, an dem du leckere und gesunde Mahlzeiten zu
            studentenfreundlichen
            Preisen genießen kannst. Ob du Lust auf ein warmes Mittagessen, einen frischen Salat oder einen süßen Snack
            hast, bei uns findest du immer etwas, das deinen Geschmack trifft. Wir bieten dir eine vielfältige Auswahl
            an regionalen, saisonalen und internationalen Speisen, die täglich frisch zubereitet werden. Außerdem achten
            wir auf eine nachhaltige und faire Beschaffung unserer Zutaten, um die Umwelt und die Menschen zu schützen.
            Komm vorbei und überzeuge dich selbst von unserem Angebot. Wir freuen uns auf deinen Besuch!
        </div>
    </div>
    <h2 id="food-menu-header">Köstlichkeiten die dich erwarten</h2>
    <div class="food-menu full-bleed">
        {!! $displayMeals !!}
    </div>
    <div class="testimonials full-bleed">
        <h2>Das sagen unsere Kunden</h2>
        <p>Überzeug dich selbst. Hör es von unseren zufriedenen Kunden!</p>
        {!! $displayTestimonials !!}
        <a href="/bewertungen">Mehr Erfahrungsberichte</a>
    </div>
    <div class="mensa-stats">
        <div><span>{{$queryVisitorCount}}</span>
            <p>Besuche</p></div>
        <div><span>{{$newsletterCount}}</span>
            <p>Anmeldungen zum Newsletter</p></div>
        <div><span>{{$mealCount}}</span>
            <p>Speisen</p></div>
    </div>
    <h2 id="contact">Interesse geweckt? Wir informieren dich!</h2>
    <form class="newsletter" action="newsletter" method="post">
        <div>
            <div>
                <label for="name">Dein Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Deinee E-Mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="lang">Sprache:</label>
                <select id="lang" name="lang">
                    <option value="de">Deutsch</option>
                    <option value="en">Englisch</option>
                </select>
            </div>
        </div>
        <div>
            <input type="checkbox" id="privacyPolicy" name="privacyPolicy" required>
            <label for="privacyPolicy">Den Datenschutzbestimmungen stimme ich zu</label>
        </div>
        <button type="submit">Zum Newsletter anmelden</button>
    </form>
    <h2 id="important">Das ist uns wichtig</h2>
    <div class="important-to-us">
        <ul>
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
    </div>

    <h2 style="text-align: center">Wir freuen uns auf deinen Besuch!</h2>
@endsection

@section("cssextra")
    <link rel="stylesheet" href="/css/meal-card.css">
@endsection

@section("jsextra")
@endsection