<?php
/**
 * Praktikum DBWT. Autoren:
 * Simon, Conrad, 3597903
 * Henning, Schreiber, 3568055
 */
?>

@extends(".layouts.layout")

@section("content")
    <h1>Gerichte</h1>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Preis Intern</th>
        </tr>
        </thead>
        <tbody>
        @forelse($meals as $index => $meal)
            <tr>
                <td>{{ $meal->name }}</td>
                <td>{{ $meal->preisintern }}€</td>
            </tr>
        @empty
            <tr>
                <td colspan="2">Es sind keine Gerichte vorhanden</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
