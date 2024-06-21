@extends('layouts.app')

@section('content')
    @include('usuarios.form', ['action' => 'Editar', 'route' => route('usuarios.update', $usuario['id']), 'method' => 'PUT'])
@endsection
