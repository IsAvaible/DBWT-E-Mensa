<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>
@extends("layouts.main_layout")

@section("content")
    <div id="intro">
        <img src="/img/salad.jpg" alt="Bild des Salatbuffets der Mensa">
        <h2 id="announcements">Willkommen auf der E-Mensa!</h2>
        <div id="description">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur cupiditate delectus dolor esse eum
            fuga
            ipsam, minima molestiae quam rerum, ut velit vero! A alias amet animi autem commodi debitis, doloribus ea
            earum
            illum natus necessitatibus, perferendis placeat quae quasi vero, vitae voluptate voluptatibus. Ducimus et
            eveniet,
            expedita facilis ipsum quae voluptas. Amet assumenda deserunt ea eaque eveniet illo inventore, magni nisi
            nulla,
            pariatur, quia quisquam ratione veritatis. Asperiores at, beatae blanditiis eius facere illo ipsam ipsum
            modi
            mollitia neque numquam odio perferendis quae quam quas voluptatem voluptatibus! Blanditiis eos illo
            inventore
            necessitatibus nostrum obcaecati possimus quod quos ratione!
        </div>
    </div>
    <h2 id="food-menu-header">Köstlichkeiten die Sie erwarten</h2>
    <div class="food-menu full-bleed">
        {!! $displayMeals !!}
    </div>
    <div class="mensa-stats">
        <div><span>{{$queryVisitorCount}}</span>
            <p>Besuche</p></div>
        <div><span>{{$newsletterCount}}</span>
            <p>Anmeldungen zum Newsletter</p></div>
        <div><span>{{$mealCount}}</span>
            <p>Speisen</p></div>
    </div>
    <h2 id="contact">Interesse geweckt? Wir informieren Sie!</h2>
    <form class="newsletter" action="newsletter" method="post">
        <div>
            <div>
                <label for="name">Ihr Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Ihre E-Mail:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="lang">Newsletter bitte in:</label>
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

    <h2 style="text-align: center">Wir freuen uns auf ihren Besuch!</h2>
@endsection

@section("cssextra")
@endsection

@section("jsextra")
@endsection