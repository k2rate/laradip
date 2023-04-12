@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">Где нас найти</h1>
    <h4 class="text-center p-1 mb-2">Мы здесь</h4>

    <img class="d-block p-1 mb-3" style="margin: 0 auto; max-width: 50%;" src="{{ asset('img/map.jpg') }}" alt="">
    
    <p class="text-center fs-5 p-1">Наш адрес: Ясная 28 дом 4 корпус 3</p>
    <p class="text-center fs-5 p-1">Номер телефона: +79089088899</p>
</div>
@endsection
