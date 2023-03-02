@extends('layouts.app')

@section('content')
    <div class="container">

        <p>{{ $product->name }}</p>
        <p>Описание: {{ $product->desc }}</p>
        <p>Цена: {{ $product->cost }}</p>
        
    </div>
@endsection
