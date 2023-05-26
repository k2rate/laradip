@extends('layouts.app')

@php
    use App\Models\Category;
@endphp

@section('content')
    <div class="container">

        <h1 class="">Каталог</h1>

        <div class="state"></div>

        <form action="{{ route('catalog') }}" method="GET" class="py-1">
            <div class="row">
                <div class="col-md-3 mb-1">
                    <select id="sort_type" class="sort-lim form-select @error('sort_type') is-invalid @enderror"
                        name="sort_type">
                        <option @if ($sort_type == 'default') selected @endif value="default">Сортировать</option>
                        <option @if ($sort_type == 'cost') selected @endif value="cost">По цене</option>
                        <option @if ($sort_type == 'name') selected @endif value="name">По наименованию</option>
                    </select>
                </div>

                <div class="col-md-3 mb-1">
                    <select id="order" class="sort-lim form-select @error('order') is-invalid @enderror" name="order">
                        <option @if ($order == 'desc') selected @endif value="desc">По убыванию</option>
                        <option @if ($order == 'asc') selected @endif value="asc">По возрастанию</option>
                    </select>
                </div>

                <div class="col-md-3 mb-1">
                    <select id="category_id" class="sort-lim form-select @error('category_id') is-invalid @enderror"
                        name="category_id">
                        <option @if ($category_id == 0) selected @endif value="0">Выбрать категорию</option>
                        @foreach ($categories as $category)
                            <option @if ($category_id == $category->id) selected @endif value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3 mb-1">
                    <button type="submit" class="btn btn-success sort-lim">Применить</button>
                </div>
            </div>

            @error('sort_type')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            @error('order')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            @error('category_id')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror


        </form>

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
                                <p class="card-text">Категория: {{ Category::find($product->category_id)->name }}</p>
                                <p class="card-text">{{ $product->description }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                            </div>
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
                            
                                <div class="card mb-3">
                                    <div class="" style="height: 210px;" onclick="$('#modal_{{ $loop->index }}').modal('show');">
                                        <img class="img-fluid" style="padding: 10px;" src="{{ asset($product->image) }}">
                                    </div>
                                    
                                    <div class="card-body">
                                        <p class="card-text" style="min-height: 45px">{{ $product->name }}</p>
                                        <p class="card-text fw-bold">{{ $product->cost }} ₽</p>

                                        <form class="" action="{{ route('bucket.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id", value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-light w-100">В корзину</button>
                                        </form>

                                    </div>
                                </div>
                            
                        </div>
                    @endforeach
                </div>

            </div>

            <div class="col-xl-3 col-lg-4 col-sm-12">

                <form class="form-ky" action="{{ route('bucket.checkout') }}">
                    @csrf
                    <button type="submit" class="btn btn-success w-100">Оформить заказ</button>
                </form>

                <div class="pb-5 h-100" style="position: relative;">
                    <div class="card h-100" style="">

                        <div class="card-header">
                            <h4 class="text-center">Корзина</h4>
                        </div>

                        <ul class="list-group list-group-flush">
                            @foreach ($bucket as $key => $elem)
                                @php($product = $elem['object'])

                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-6 d-flex justify-content-center">
                                            <img class="img-fluid d-block" style="max-height: 130px;"
                                                src="{{ $product->image }}">
                                        </div>
                                        <div class="col-6">
                                            <p>{{ $product->name }}</p>
                                            <p class="fw-bold">{{ $product->cost }} ₽</p>

                                            <div class="d-flex align-items-center">
                                                <form class="me-3" action="{{ route('bucket.remove') }}"
                                                    method="POST" index={{ $key }}>
                                                    @csrf
                                                    <input type="hidden" name="index", value="{{ $key }}">
                                                    <button type="submit" class="btn btn-danger product-btn">-</button>
                                                </form>

                                                <p class="me-3" id="product-count" style="margin: 0;">
                                                    {{ $elem['count'] }}
                                                </p>

                                                <form class="" action="{{ route('bucket.add') }}" method="POST"
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
