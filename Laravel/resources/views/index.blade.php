@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <h1>Bienvenido a la Gestión de Usuarios</h1>
    <div class="list-group">
        <a href="{{ url('/usuarios/vue') }}" class="list-group-item list-group-item-action">Vue.js</a>
        <a href="{{ url('/usuarios/laravel') }}" class="list-group-item list-group-item-action">Laravel</a>
    </div>
@endsection
