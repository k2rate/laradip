@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Каталог</h1>

        <p>Наши товары: </p>

        <div class="row">
            @foreach($products as $product)
            
            <div class="col-md-4">
                <div class="tovar">
                    <img src="{{ asset($product->image) }}" alt="" class="img-fluid">
                    <a href="tovar/{{ $product->id }}" class="btn btn-primary tovbtn">Заказать</a>
                </div>
            </div>
            
            @endforeach
        </div>
    </div>
@endsection
