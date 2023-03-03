@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Товар</h1>
        <p>Выбранный товар: </p>

        <div class="row">
            <div class="col-md-6">
                <div class="tovar-desc">
                    <p class="fs-4">Название: {{ $product->name }}</p>
                    <p class="fs-4">Цена: {{ $product->cost }}</p>
                    <p class="fs-4">Описание: {{ $product->description }}</p>
                    <p class="fs-4">Страна: {{ $product->country }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <img src="{{ asset($product->image) }}" alt="" class="img-fluid selected-tovar">
                </div>
            </div>
            <form id="addbucket-form" action="{{ route('bucket.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="btn btn-primary">Добавить в корзину</button>
            </form>
        </div>
    </div>
@endsection
