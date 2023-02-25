@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Товар</h1>
        <p>Выбранный товар: </p>

        <div class="row">
            <div class="col-md-6">
                <div class="tovar-desc">
                    <p class="fs-4">Описание: {{ session('tovar')->desc }}</p>
                    <p class="fs-4">Цена: {{ session('tovar')->cost }}</p>
                    <p class="fs-4">Модель: {{ session('tovar')->model }}</p>
                    <p class="fs-4">Страна: {{ session('tovar')->country }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <img src="../img/{{  $tovar->img }}" alt="" class="img-fluid selected-tovar">
                </div>
            </div>
            <form id="addbucket-form" action="{{ route('addbucket') }}" method="POST">
                @csrf
                <input type="hidden" name="tovar_id" value="{{ $tovar->id }}">
                <button class="btn btn-primary">Добавить в корзину</button>
            </form>
        </div>
    </div>
@endsection
