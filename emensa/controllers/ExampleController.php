<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/kategorie.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/../models/gericht.php');

class ExampleController
{
    public function m4_7a_queryparameter(RequestData $rd): string
    {
        $name = $rd->query['name'] ?? 'Welt';
        return view('examples.m4_7a_queryparameter', [
            'name' => $name,
            'request' => $rd,
            'url' => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"
        ]);
    }

    public function m4_7b_kategorie(): string
    {
        return view('examples.m4_7b_kategorie', ['categories' => db_kategorie_select_all()]);
    }

    public function m4_7c_gerichte(): string
    {
        return view('examples.m4_7c_gerichte', ['meals' => db_gericht_select_all()]);
    }

    public function m4_7d_layout(RequestData $rd): string
    {
        $no = $rd->query['no'] ?? '1';

        return view('examples.pages.m4_7d_page_' . $no);
    }
}