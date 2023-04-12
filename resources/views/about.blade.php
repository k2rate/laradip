@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-5">EatShop</h1>

        <h4 class="text-center p-1 mb-2">Мы новая динамично развивающаяся компания. Занимаемся доставкой еды на дом.</h4>
        <img class="d-block p-1 mb-3" style="margin: 0 auto; max-width: 50%;" src="{{ asset('img/main.webp') }}" alt="">

        <p class="text-center fs-5 p-2 mb-5">Мы занимаемся доставкой различной еды на дом.
            В наш ассортимент входят такие категории товаров как: пицца, суши, торты, рыба, фастфуд.
            Доставкой товаров занимаются наши курьеры.
            Сделать заказ в нашем сервисе максимально просто!
            Для этого вам необходимо заполнить такие поля как адрес, номер телефона и ваше имя.</p>

        <a href="{{ route('catalog') }}" class="btn btn-success fs-3 d-block mb-5" style="max-width: 700px; margin: 0 auto;">Попробовать</a>

        <!--
            <div style="height: 400px; width: 700px; margin: 0 auto;">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-indicators" style="background-color:rgba(0, 0, 0, 0.1);">
                        @foreach ($products as $product)
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->index }}"
                                @if ($loop->index == 0) class="active" aria-current="true" @endif aria-label="Slide {{ $loop->index }}"></button>
    @endforeach
                    </div>
                    

                    <div class="carousel-inner h-100" style="background-color: white">
                        @foreach ($products as $product)
    <div class="carousel-item @if ($loop->index == 0) active @endif">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ asset($product->image) }}" class="img-fluid d-block h-100" style="" alt="...">
                                    </div>
                                </div>
                                
                            </div>
    @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>



     
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <h3>Последние добавленные товары</h3>
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" style="background-color: white">
                                @foreach ($products as $product)
    <div class="carousel-item @if ($loop->index == 0) active @endif">
                                        <img class="d-block w-100" src="{{ asset($product->image) }}">
                                    </div>
    @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>


            -->

    </div>
@endsection
