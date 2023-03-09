@extends('layouts.app')

@php
    use App\Models\Category;
@endphp

@section('content')
    <div class="container">
        <h1>Каталог</h1>

        <div class="state">
        </div>

        <p>Наши товары: </p>

        <form action="{{ route('catalog') }}" method="GET" class="py-1">
            <select id="category_id" class="my-1 form-select @error('category_id') is-invalid @enderror" name="category_id">
                <option @if ($category_id == 0) selected @endif value="0">Выбрать категорию</option>
                @foreach ($categories as $category)
                    <option @if ($category_id == $category->id) selected @endif value="{{ $category->id }}">
                        {{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            <button type="submit" class="btn btn-primary">Применить</button>
        </form>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <a href="{{ route('product', $product->id) }}" style="text-decoration: none; color: inherit;">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset($product->image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">Категория: {{ Category::find($product->category_id)->name }}</p>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text">Количество: {{ $product->count }}</p>
                                <p class="card-text">Цена: {{ $product->cost }}</p>
                                @auth
                                    <form class="ajax-form" action="{{ route('bucket.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id", value="{{ $product->id }}">
                                        <button type="submit" class="btn btn-primary product-btn">В корзину</button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
@endsection
