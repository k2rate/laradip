@extends('layouts.app')

@php
    use App\Models\Category;
@endphp

@section('content')
    <div class="container">

        <h1 class="">Каталог</h1>

        <div class="state"></div>

        <div class="accordion accordion-flush d-md-none d-sm-block" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header border">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Настроить показ товаров
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body px-0">
                        @include('includes.catalog.sort')
                    </div>
                </div>
            </div>
        </div>

        <div class="d-sm-none d-md-block d-none">
            @include('includes.catalog.sort')
        </div>

        <!-- <h4 class="mt-5">Наши товары: </h4> -->
        <div class="mb-4"></div>

        <div class="modals-block">
            @foreach ($products as $product)
                <!-- Modal -->
                <div class="modal fade" id="modal_{{ $loop->index }}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="modallabel_{{ $loop->index }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modallabel_{{ $loop->index }}">{{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="card-text fw-bold">{{ $product->cost }} ₽</p>
                                <p class="card-text">Категория: {{ $product->category->name }}</p>
                                <p class="card-text">{{ $product->description }}</p>
                            </div>
                            <div class="modal-footer"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="row">
            <div class="col-xl-9 col-lg-8 col-sm-12">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-xl-3 col-md-4 col-6">
                            <x-product-card modal_id="modal_{{ $loop->index }}" :product="$product">
                                <x-form route="bucket.add" class="ajax-form-basket-append" method="POST" product_id="{{ $product->id }}">
                                    <input type="hidden" name="id", value="{{ $product->id }}">
                                    <x-submit class="btn-light w-100">В корзину</x-submit>
                                </x-form>
                            </x-product-card>
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="col-xl-3 col-lg-4 col-sm-12 d-sm-none d-md-block d-none">
                <x-form class="form-ky" route="bucket.checkout">
                    <x-submit class="btn-success w-100">Оформить заказ</x-submit>
                </x-form>

                <div class="card h-100" id="basketWidget">
                    <div class="card-header">
                        <h4 class="text-center">Корзина</h4>
                    </div>

                    @include('includes.basket.list')
                </div>


            </div>
        </div>


    </div>
@endsection
