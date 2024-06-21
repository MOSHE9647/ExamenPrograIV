<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $frameworks = [
        ['name' => 'React', 'url' => 'http://localhost:3000/react'],
        ['name' => 'Angular', 'url' => 'http://localhost:4200/angular'],
        ['name' => 'Vue', 'url' => 'http://localhost:8081/vue'],
        ['name' => 'Laravel', 'url' => 'https://laravel.com'],
    ];

    return view('home', compact('frameworks'));
});

Route::get('/laravel', function () {
    return view('laravel'); //Cambiar nombre por vista dónde va a estar la tabla
});