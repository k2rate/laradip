@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">EatShop</h1>

        <h4 class="text-center p-1 mb-2">Мы новая динамично развивающаяся компания. Занимаемся доставкой еды на дом.</h4>

        <div class="row justify-content-center">
            <div class="col-10 col-md-8 col-xl-6">
                <img class="d-block img-fluid mx-auto mb-3" src="{{ asset('img/main.webp') }}" alt="">
            </div>
        </div>
        
        <p class="text-center fs-5 p-2 mb-5">Мы занимаемся доставкой различной еды на дом.
            В наш ассортимент входят такие категории товаров как: пицца, суши, торты, рыба, фастфуд.
            Доставкой товаров занимаются наши курьеры.
            Сделать заказ в нашем сервисе максимально просто!
            Для этого вам необходимо заполнить такие поля как адрес, номер телефона и ваше имя.</p>

        <a href="{{ route('catalog') }}" class="btn btn-success fs-3 d-block mb-5" style="max-width: 700px; margin: 0 auto;">Попробовать</a>


    </div>
@endsection
