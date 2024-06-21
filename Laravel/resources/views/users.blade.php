@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Gestión de Usuarios</h1>
    <div class="row">
        <div class="col-12 d-flex mb-4">
            <button class="btn btn-primary" onclick="toggleAddFormVisibility()">Añadir</button>
        </div>
        <div class="col-12 mb-4">
            @include('users.table', ['users' => $users])
        </div>
        <div class="col-12" id="addUserForm" style="display: none;">
            @include('users.add-form')
        </div>
        <div class="col-12" id="editUserForm" style="display: none;">
            @include('users.edit-form', ['user' => null])
        </div>
        <div class="col-12" id="infoUserForm" style="display: none;">
            @include('users.info-form', ['user' => null])
        </div>
    </div>
</div>

<script>
    function toggleAddFormVisibility() {
        document.getElementById('addUserForm').style.display = 'block';
        document.getElementById('editUserForm').style.display = 'none';
        document.getElementById('infoUserForm').style.display = 'none';
    }

    function toggleEditFormVisibility(user) {
        document.getElementById('editUserForm').style.display = 'block';
        document.getElementById('addUserForm').style.display = 'none';
        document.getElementById('infoUserForm').style.display = 'none';
        // Fill the form with user data
    }

    function toggleInfoFormVisibility(user) {
        document.getElementById('infoUserForm').style.display = 'block';
        document.getElementById('editUserForm').style.display = 'none';
        document.getElementById('addUserForm').style.display = 'none';
        // Fill the form with user data
    }
</script>
@endsection
