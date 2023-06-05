@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <x-card title="Активные заказы" class="mb-3">
                    <div class="row">
                        @foreach ($checkouts as $obj)
                            @php
                                $checkout = $obj['data'];
                                $bucket = $obj['bucket'];
                                $summary = $obj['summary'];
                            @endphp


                            <div class="col-md-3">
                                <x-card title="Заказ #{{ $checkout->id }}" class="mb-3">
                                    <p>Дата поступления: {{ $checkout->updated_at }}</p>
                                    <p>Количество товаров: {{ $summary }}</p>
                                    <p>Номер для связи: {{ $checkout->phone }}</p>
                                    <p>Адрес: {{ $checkout->address }}</p>

                                    <x-form method="POST" route="admin.finishCheckout">
                                        <input type="hidden" name="id" value="{{ $checkout->id }}">
                                        <x-submit class="btn-primary w-100">Завершить</x-submit>
                                    </x-form>
                                </x-card>
                            </div>
                        @endforeach
                    </div>
                </x-card>
            </div>

            <div class="col-md-4">
                <x-card title="Добавление категории">
                    <x-form method="POST" route="admin.addCategory">
                        <x-input name="name">Название категории</x-input>
                        <x-submit class="btn-success w-100">Добавить категорию</x-submit>
                    </x-form>
                </x-card>
            </div>

            <div class="col-md-8">
                <x-card title="Категории" class="h-100">
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-md-4 mb-1">
                                <x-card>
                                    <h5 class="mt-1">{{ $category->name }}</h5>
                                    <x-form route="admin.deleteCategory" method="POST">
                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                        <x-submit class="btn-danger">Удалить категорию</x-submit>
                                    </x-form>
                                </x-card>
                            </div>
                        @endforeach
                    </div>
                </x-card>
            </div>
        </div>

        <x-card title="Редактирование товаров" class="mt-3">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-xl-2 col-md-3 col-6">
                        <x-product-card :product="$product">
                            <a class="btn btn-primary w-100"
                                href="{{ route('admin.product', $product->id) }}">Редактировать</a>

                        </x-product-card>
                    </div>
                @endforeach
            </div>
        </x-card>

        <x-card title="Добавление нового товара" class="mt-3">
            <h3>Добавление нового товара</h3>
            <x-form route="admin.storeProduct" method="POST" enctype="multipart/form-data">
                <x-input name="name">Имя товара</x-input>

                <x-select name="category_id" label="Категория" placeholder="Выбрать категорию">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>

                <x-input name="description">Описание</x-input>
                <x-input name="cost">Цена</x-input>
                <x-input name="count">Количество</x-input>
                <x-input name="image" type="file">Картинка</x-input>

                <x-submit class="btn-success w-100">Добавить</x-submit>
            </x-form>
        </x-card>



    </div>
@endsection
