@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Корзина</h1>

        <div class="state">
        </div>

        <div class="row">

            @foreach ($bucket as $key => $elem)
                @php($product = $elem['object'])

                <div class="col-md-3" id="card-{{ $key }}">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ $product->image }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Цена: {{ $product->cost }}</p>
                            <p class="card-text">В корзине: <span id="product-count">{{ $elem['count'] }}</span></p>
                            <form class="ajax-form-append" action="{{ route('bucket.add') }}" method="POST" index={{ $key }}>
                                @csrf
                                <input type="hidden" name="id", value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary product-btn">Добавить ещё</button>
                            </form>

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
