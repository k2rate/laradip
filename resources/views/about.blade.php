@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>О нас</h1>
        <p>Мы - Молодая компания "True Games" занимаемся продажей игровых приставок и аксессуаров. Мы продаем множество
            игровых устройств таких как консоли, приставки и даже игры. Всё очень дёшего невероятно.</p>

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
