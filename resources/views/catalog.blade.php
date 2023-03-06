@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Каталог</h1>

        <div class="state">
        </div>

        <p>Наши товары: </p>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset($product->image) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Количество: {{ $product->count }}</p>
                            <p class="card-text">Цена: {{ $product->cost }}</p>
                            <form class="ajax-form" action="{{ route('bucket.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id", value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary product-btn">В корзину</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
