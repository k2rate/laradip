@extends('layouts.app')

@php
use App\Models\Category;
@endphp

@section('content')
    <div class="container">
        <h1>Корзина</h1>

        <div class="state">
        </div>

        <style>
            .ky {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .ky-item {
                padding: 0px 10px;
            }
        </style>

        


        <div class="row">

            <form action="">
                <button type="submit" class="btn btn-primary">Оформить заказ</button>
            </form>

            @foreach ($bucket as $key => $elem)
                @php($product = $elem['object'])

                <div class="col-md-3" id="card-{{ $key }}">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ $product->image }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">Категория: {{ Category::find($product->category_id)->name }}</p>
                            <p class="card-text">{{ $product->description }}</p>
                            <p class="card-text">Цена: {{ $product->cost }}</p>

                            <div class="ky">
                                <form class="ajax-form-remove ky-item" action="{{ route('bucket.remove') }}" method="POST" index={{ $key }}>
                                    @csrf
                                    <input type="hidden" name="index", value="{{ $key }}">
                                    <button type="submit" class="btn btn-danger product-btn">-</button>
                                </form>

                                <p class="ky-item" id="product-count" style="margin: 0;">{{ $elem['count'] }}</p>
                                
                                <form class="ajax-form-append ky-item" action="{{ route('bucket.add') }}" method="POST" index={{ $key }}>
                                    @csrf
                                    <input type="hidden" name="id", value="{{ $product->id }}">
                                    <button type="submit" class="btn btn-primary product-btn">+</button>
                                </form>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
