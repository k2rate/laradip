@extends('layouts.app')

@php
    use App\Models\Category;
@endphp

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-9">
                <x-card title="Редактирование товара" class="h-100">
                    <x-form route="admin.editProduct" method="POST">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <x-input name="name" value="{{ $product->name }}">Имя товара</x-input>

                        <x-select label="Категория" name="category_id">
                            <option @if ($product->category_id == 0) selected @endif value="0">Выбрать
                                категорию</option>
                            @foreach ($categories as $category)
                                <option @if ($product->category_id == $category->id) selected @endif value="{{ $category->id }}">
                                    {{ $category->name }}</option>
                            @endforeach
                        </x-select>

                        <x-input name="description" value="{{ $product->description }}">Описание</x-input>
                        <x-input name="cost" value="{{ $product->cost }}">Цена</x-input>
                        <x-input name="count" value="{{ $product->count }}">Количество</x-input>

                        <x-submit class="btn-primary">Сохранить</x-submit>
                    </x-form>
                </x-card>
            </div>

            <div class="col-3">
                <x-product-card class="h-100" :product="$product">
                    <x-form route="admin.deleteProduct" method="POST">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <x-submit class="btn-danger w-100">Удалить товар</x-submit>
                    </x-form>
                </x-product-card>
            </div>

            <div class="col-12">

                <x-card title="Редактирование картинки" class="mt-3">
                    <x-form route="admin.editProductImage" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <x-input type="file" name="image">Картинка</x-input>
                        <x-submit class="btn-primary">Сохранить</x-submit>
                    </x-form>
                </x-card>

            </div>
        </div>

    </div>
@endsection
