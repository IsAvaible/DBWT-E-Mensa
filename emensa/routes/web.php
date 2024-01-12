<?php
/**
 * Mapping of paths to controllers.
 * Note, that the path only supports one level of directory depth:
 *     /demo is ok,
 *     /demo/subpage will not work as expected
 */

return array(
    '/' => "HomeController@index",
    '/wunschgericht' => "HomeController@desired_meal",
    '/newsletter' => "HomeController@newsletter",
    '/profil' => "HomeController@profile",
    '/anmeldung' => "HomeController@login",
    '/abmeldung' => "HomeController@logout",
    '/anmeldung_verifizieren' => "HomeController@login_check",
    '/bewertung' => "HomeController@rating",
    '/bewertung_abschicken' => "HomeController@submit_rating",
    '/bewertungen' => "HomeController@ratings",
    '/bewertung_hervorheben' => "HomeController@highlight_rating",
    '/bewertung_entvorheben' => "HomeController@unhighlight_rating",
    '/meine_bewertungen' => "HomeController@my_ratings",
    '/demo' => "DemoController@demo",
    '/dbconnect' => 'DemoController@dbconnect',
    '/debug' => 'HomeController@debug',
    '/error' => 'DemoController@error',
    '/requestdata' => 'DemoController@requestdata',

    // Erstes Beispiel:
    '/m4_7a_queryparameter' => 'ExampleController@m4_7a_queryparameter',
    '/m4' => 'ExampleController@m4_7a_queryparameter',
    '/m4_7b_kategorie' => 'ExampleController@m4_7b_kategorie',
    '/m4_7c_gerichte' => 'ExampleController@m4_7c_gerichte',
    '/m4_7d_layout' => 'ExampleController@m4_7d_layout',
);