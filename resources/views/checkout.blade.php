@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($status == 'confirmed')
            <div class="modal" tabindex="-1" id="exampleModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Заказ оформлен</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Ваш заказ оформлен. Номер вашего заказа: </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        <form action="{{ route('bucket.checkoutSubmit') }}" method="POST">
            @csrf
            <h2>Оформление заказа</h2>
            {{-- <h3>{{ $status }}</h3> --}}

            <div class="row">
                <div class="col-lg-6 col-sm-12 p-2">
                    <div class="card">
                        <div class="card-header">
                            Детали заказа
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="name" class="form-label">Как к вам обращаться</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-12">
                                    <label for="address" class="form-label">Адрес доставки</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>
                                <div class="col-12">
                                    <label for="comment" class="form-label">Комментарий к заказу</label>
                                    <input type="text" class="form-control" id="comment" name="comment" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Почта</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="phone" class="form-label">Номер телефона</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6 col-sm-12 p-2">
                    <div class="card">
                        <div class="card-header">
                            Оплата заказа
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <h4 class="fw-bold">Итого</h4>
                                    <div class="row p-1">
                                        <div class="col-4">Стоимость заказа </div>
                                        <div class="col-3 fw-bold"> {{ $summary }} ₽</div>
                                    </div>
                                    <div class="row p-1">
                                        <div class="col-4">Доставка </div>
                                        <div class="col-3 fw-bold"> 0 ₽</div>
                                    </div>
                                    <div class="row p-1">
                                        <div class="col-4">Работа сервиса </div>
                                        <div class="col-3 fw-bold"> 0 ₽</div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputState" class="form-label">Способ оплаты</label>
                                </div>
                                <div class="col-6">
                                    <select id="inputState" class="form-select">
                                        <option selected>Оплата при получении</option>
                                    </select>
                                </div>
                                <div class="col-6"></div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success">Оформить заказ</button>
                                    <span class="fw-bold ps-3 fs-5">{{ $summary }} ₽</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-sm-12 col-lg-6 p-2">
                <div class="card mt-3">
                    <div class="card-header">
                        Ваш заказ
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach ($bucket as $key => $elem)
                                @php($product = $elem['object'])

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-4 d-flex justify-content-center">
                                            <img class="img-fluid d-block" style="max-height: 130px;"
                                                src="{{ $product->image }}">
                                        </div>
                                        <div class="col-4">
                                            <p>{{ $product->name }}</p>
                                            <p class="fw-bold">{{ $product->cost }} ₽</p>

                                            <div class="d-flex align-items-center">
                                                <form class="me-3" action="{{ route('bucket.remove') }}" method="POST"
                                                    index={{ $key }}>
                                                    @csrf
                                                    <input type="hidden" name="index", value="{{ $key }}">
                                                    <button type="submit" class="btn btn-danger product-btn">-</button>
                                                </form>

                                                <p class="me-3" id="product-count" style="margin: 0;">
                                                    {{ $elem['count'] }}
                                                </p>

                                                <form action="{{ route('bucket.add') }}" method="POST"
                                                    index={{ $key }}>
                                                    @csrf
                                                    <input type="hidden" name="id", value="{{ $product->id }}">
                                                    <button type="submit" class="btn btn-success product-btn">+</button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>

                                </li>
                            @endforeach


                        </ul>
                    </div>
                </div>
            </div>

        </div>





    </div>
@endsection


@section('scripts')
    @if ($status == 'confirmed')
        <script>
            $(document).ready(function() {
                $("#exampleModal").modal('show');
            });
        </script>
    @endif
@endsection
