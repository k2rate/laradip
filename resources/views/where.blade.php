@extends('layouts.app')

@section('content')
    <div class="container">
        <style>
            .bg-gray {
                background-color: #ffffff;
            }

            .where-block {
                max-width: 1000px;
                margin: 0 auto;
            }
        </style>

        <div class="row">
            <div class="col-12">
                <h2>EatShop</h2>
                <p class="fw-bold m-0">Клиентская поддержка</p>
                <p>Если у вас вопрос по вашему заказу, напишите нам на eatshop@eatshop.ru и звонить по телефону 8 721
                    222-83-43.</p>
                <p>Обратите внимание, что мы не принимаем заказы по телефону. Сделать заказ всегда можно на сайте или через
                    мобильные приложения.</p>

                <p class="fw-bold m-0">Местоположение</p>
                <p>Наш офис располагается по адресу Ясная 28 дом 4 корпус 3.</p>
            </div>



            {{-- <img class="d-block" style="margin: 0 auto; max-width: 100%;" src="{{ asset('img/map.jpg') }}" alt=""> --}}

        </div>
    </div>
@endsection


