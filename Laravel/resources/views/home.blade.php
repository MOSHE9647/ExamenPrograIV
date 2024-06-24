@extends('layouts.app')

@section('content')
<div class="container mt-5 w-50">
    <h1 class="text-center">Enlaces a los Frameworks</h1>
    <ul class="list-group">
        @foreach($frameworks as $link)
            <li class="list-group-item list-group-item-action list-group-item-light">
                <a href="{{ $link['url'] }}">{{ $link['name'] }}</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection