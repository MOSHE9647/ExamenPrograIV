@section('content')
<div class="container mt-5 w-50">
    <h1 class="text-center">Enlaces a los Frameworks</h1>
    <ul class="list-group">
        @foreach ($frameworks as $link)
        <li class="list-group-item list-group-item-action list-group-item-light">
            @if (Str::startsWith($link['url'], 'http://') || Str::startsWith($link['url'], 'https://'))
            <a href="{{ $link['url'] }}">{{ $link['name'] }}</a>
            @else
            <a href="{{ route('framework', ['framework' => $link['url']]) }}">{{ $link['name'] }}</a>
            @endif
        </li>
        @endforeach
    </ul>
</div>
@endsection
