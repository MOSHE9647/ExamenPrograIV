@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Gestión de Usuarios</h1>
    <div id="user-app">
        <div class="row">
            @if (!$isAddFormVisible)
                <div class="col-12 d-flex">
                    <button class="btn btn-primary" onclick="toggleAddFormVisibility()">Añadir</button>
                </div>
            @endif
            <div class="col-12 mb-4">
                @include('users_table', ['users' => $users])
            </div>
            @if ($isAddFormVisible)
                <div class="col-12">
                    @include('add_user_form')
                </div>
            @endif
            @if ($isEditFormVisible)
                <div class="col-12">
                    @include('edit_user_form', ['selectedUser' => $selectedUser])
                </div>
            @endif
            @if ($isInfoFormVisible)
                <div class="col-12">
                    @include('info_user_form', ['selectedUser' => $selectedUser])
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{ asset('scripts.js') }}"></script>
<script>
    function toggleAddFormVisibility() {
        window.location.href = '{{ route("toggleAddFormVisibility") }}';
    }
</script>

@endsection