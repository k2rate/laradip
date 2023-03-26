@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>О нас</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni animi totam debitis officiis, quis sed molestiae cum, sit omnis fuga nihil sequi. Modi animi quam architecto repudiandae sit exercitationem eius?</p>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h3>Последние добавленные товары</h3>
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner" style="background-color: white">
                        @foreach ($products as $product)
                            <div class="carousel-item @if($loop->index == 0) active @endif">
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


        

    </div>
@endsection
