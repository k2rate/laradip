@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Корзина</h1>
        @foreach($products as $product)
        <p class="fs-3">{{ $product->desc }} Цена: {{ $product->cost }} Модель: {{ $product->model }} </p>
        @endforeach
    </div>
@endsection
