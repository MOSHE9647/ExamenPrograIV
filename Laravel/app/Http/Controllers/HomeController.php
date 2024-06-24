<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $frameworks = [
            ['name' => 'React', 'url' => 'http://localhost:3000/react'],
            ['name' => 'Angular', 'url' => 'http://localhost:4200/angular'],
            ['name' => 'Vue', 'url' => 'http://localhost:8081/vue'],
            ['name' => 'Laravel', 'url' => route('user.index')]
        ];
        return view('home', compact('frameworks'));
    }
}