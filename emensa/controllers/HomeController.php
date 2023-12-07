<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/gericht.php');
include("../models/besucher.php");
include("../models/meals.php");
include("../models/newsletter.php");


/* Datei: controllers/HomeController.php */

class HomeController
{
    public function index(RequestData $request)
    {
        //Show dishes
        $gerichteDarstellen = gerichte_dartsellen();

        //Statistic data
        $queryVisitorCount = htmlspecialchars(queryVisitorCount()) ?? 'X';
        $newsletterCount = newsletterCount();
        $mealCount = htmlspecialchars(queryMealCount()) ?? 'X';

        return view('home', ['rd' => $request, 'queryVisitorCount' => $queryVisitorCount, 'newsletterCount' => $newsletterCount, 'mealCount' => $mealCount, 'gerichteDarstellen' => $gerichteDarstellen]);
    }

    public function debug(RequestData $request)
    {
        return view('debug');
    }
}