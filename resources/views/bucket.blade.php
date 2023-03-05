@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Корзина</h1>

        <div class="row">

            @foreach ($products as $key => $product)
                <div class="col-md-3" id="card-{{ $key }}">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ $product->image }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Цена: {{ $product->cost }}</p>

                            <form class="ajax-form-remove" action="{{ route('bucket.remove') }}" method="POST" index={{ $key }}>
                                @csrf
                                <input type="hidden" name="index", value="{{ $key }}">
                                <button type="submit" class="btn btn-danger product-btn">Удалить из корзины</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
