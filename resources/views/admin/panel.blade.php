@extends('layouts.app')

@section('content')
    <div class="container">


        <div class="row">

            <div class="col-md-12">

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="card-title">Активные заказы</h5>
                    </div>

                    <div class="card-body">

                        @foreach ($checkouts as $obj)
                            @php
                                $checkout = $obj['data'];
                                $bucket = $obj['bucket'];
                                $summary = $obj['summary'];
                            @endphp

                            <div class="row">
                                <div class="col-md-3">

                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="card-title">
                                                Заказ #{{ $checkout->id }}
                                            </h5>
                                        </div>

                                        <div class="card-body">
                                            <p>Дата поступления: {{ $checkout->updated_at }}</p>
                                            <p>Количество товаров: {{ $summary }}</p>
                                            <p>Номер для связи: {{ $checkout->phone }}</p>

                                            <a href="" class="btn btn-primary w-100">Подробнее</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Добавление категории</h5>
                    </div>

                    <div class="card-body d-flex justify-content-center align-items-center">

                        <form class="w-75" action="{{ route('admin.addCategory') }}" method="POST">
                            @csrf

                            <label for="name" class="my-1">Название категории</label>
                            <input id="name" name="name" type="text"
                                class="form-control my-1 @error('name') is-invalid @enderror">

                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror

                            <button class="btn btn-primary my-1 w-100" type="submit">Добавить категорию</button>
                        </form>


                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">Категории</h5>
                    </div>

                    <div class="card-body">

                        <div class="row">
                            @foreach ($categories as $category)
                                <div class="col-md-4 mb-1">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="mt-1">{{ $category->name }}</h5>
                                            <form action="{{ route('admin.deleteCategory') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $category->id }}">
                                                <button class="btn btn-danger" type="submit">Удалить категорию</button>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">Редактирование товаров</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-xl-2 col-md-3 col-6">

                            <div class="card mb-3">
                                <div class="" style="" onclick="$('#modal_{{ $loop->index }}').modal('show');">
                                    <img class="img-fluid" style="padding: 10px;" src="{{ asset($product->image) }}">
                                </div>

                                <div class="card-body">
                                    <p class="card-text" style="min-height: 45px">{{ $product->name }}</p>
                                    <p class="card-text fw-bold">{{ $product->cost }} ₽</p>

                                    <a class="btn btn-primary w-100"
                                        href="{{ route('admin.product', $product->id) }}">Редактировать</a>

                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title">
                    Добавление нового товара
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.storeProduct') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h3>Добавление нового товара</h3>
                    <div class="mb-3">

                        <label for="name" class="col-sm-2 col-form-label">Имя товара</label>
                        <input id="name" name="name" type="text"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                        <label for="category_id" class="col-sm-2 col-form-label">Категория</label>
                        <select id="category_id" class="form-select @error('category_id') is-invalid @enderror"
                            name="category_id">
                            <option selected>Выбрать категорию</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                        <label for="description" class="col-sm-2 col-form-label">Описание</label>
                        <input id="description" name="description" type="text"
                            class="form-control @error('description') is-invalid @enderror">
                        @error('description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                        <label for="cost" class="col-sm-2 col-form-label">Цена</label>
                        <input id="cost" name="cost" type="text"
                            class="form-control @error('cost') is-invalid @enderror">
                        @error('cost')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                        <label for="count" class="col-sm-2 col-form-label">Количество</label>
                        <input id="count" name="count" type="text"
                            class="form-control @error('count') is-invalid @enderror">
                        @error('count')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                        <!--
                                                                
                                                                <label for="country" class="col-sm-2 col-form-label">Страна</label>
                                                                <input id="country" name="country" type="text"
                                                                    class="form-control @error('country') is-invalid @enderror">
                                                                @error('country')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
                
                                                                <label for="year" class="col-sm-2 col-form-label">Год выпуска</label>
                                                                <input id="year" name="year" type="text"
                                                                    class="form-control @error('year') is-invalid @enderror">
                                                                @error('year')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
    @enderror
                                                                
                                                                -->


                        <label for="image" class="form-label">Картинка</label>
                        <input id="image" name="image" type="file"
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror

                        <div class="pt-2"><button class="btn btn-primary">Добавить</button></div>

                    </div>
                </form>
            </div>
        </div>



    </div>
@endsection
