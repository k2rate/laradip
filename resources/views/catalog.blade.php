@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Каталог</h1>

        <p>Наши товары: </p>

        <div class="row">
            @foreach(session('tovars') as $tovar)

            
            <div class="col-md-4">
                <div class="tovar">
                    <img src="img/{{ $tovar->img }}" alt="" class="img-fluid">
                    <a href="tovar/{{ $tovar->id }}" class="btn btn-primary tovbtn">Заказать</a>
                </div>
            </div>

            @endforeach
        </div>
    </div>
@endsection
