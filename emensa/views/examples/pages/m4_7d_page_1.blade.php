<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>

@extends('layouts.m4_7d_layout')

@section('title', 'Page 1')

@section('header')
    <h1>Header of Page 1</h1>
@endsection

@section('main')
    <p>Main content of Page 1</p>

    <form action="/m4_7d_layout" method="get">
        <input type="hidden" name="no" value="2">
        <button type="submit">Switch to Page 2</button>
    </form>
@endsection

@section('footer')
    <p>Footer of Page 1</p>
@endsection
