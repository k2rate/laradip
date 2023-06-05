@props(['method' => 'GET', 'route'])

<form method={{ $method }} action="{{ route($route) }}" {{ $attributes }}>
    @if ($method == 'POST')
        @csrf
    @endif

    {{ $slot }}
</form>
