@extends('layouts.app')

@section('content')
    @include('usuarios.form', ['action' => 'Crear', 'route' => route('usuarios.store'), 'method' => 'POST'])
@endsection
