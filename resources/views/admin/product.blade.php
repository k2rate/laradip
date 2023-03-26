@extends('layouts.app')

@php
    use App\Models\Category;
@endphp

@section('content')
    <div class="container">

        <img src="{{ asset($product->image) }}" alt="" class="img-fluid" style="max-height: 300px">


        <h3>Редактирование товара</h3>

        <form action="{{ route('admin.deleteProduct') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <button type="submit" class="btn btn-danger">Удалить товар</button>
        </form>

        <form action="{{ route('admin.editProduct') }}" method="POST">
            @csrf

            <input type="hidden" name="id" value="{{ $product->id }}">

            <div class="mb-3">
                <label for="name" class="col-sm-2 col-form-label">Имя товара</label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    value="{{ $product->name }}">
                @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

                <label for="category_id" class="col-sm-2 col-form-label">Категория</label>
                <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                    <option @if ($product->category_id == 0) selected @endif value="0">Выбрать категорию</option>
                    @foreach ($categories as $category)
                        <option @if ($product->category_id == $category->id) selected @endif value="{{ $category->id }}">
                            {{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror


                <label for="description" class="col-sm-2 col-form-label">Описание</label>
                <input id="description" name="description" type="text"
                    class="form-control @error('description') is-invalid @enderror" value="{{ $product->description }}">
                @error('description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

                <label for="cost" class="col-sm-2 col-form-label">Цена</label>
                <input id="cost" name="cost" type="text" class="form-control @error('cost') is-invalid @enderror"
                    value="{{ $product->cost }}">
                @error('cost')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

                <label for="count" class="col-sm-2 col-form-label">Количество</label>
                <input id="count" name="count" type="text"
                    class="form-control @error('count') is-invalid @enderror" value="{{ $product->count }}">
                @error('count')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                
                <!--
                    <label for="country" class="col-sm-2 col-form-label">Страна</label>
                <input id="country" name="country" type="text"
                    class="form-control @error('country') is-invalid @enderror" value="{{ $product->country }}">
                @error('country')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror

                <label for="year" class="col-sm-2 col-form-label">Год выпуска</label>
                <input id="year" name="year" type="text" class="form-control @error('year') is-invalid @enderror"
                    value="{{ $product->year }}">
                @error('year')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                -->
                

                <div class="pt-2"><button class="btn btn-primary">Сохранить</button></div>

            </div>
        </form>

        <h3>Редактирование картинки</h3>
        <form action="{{ route('admin.editProductImage') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $product->id }}">

            <label for="image" class="form-label">Картинка</label>
            <input id="image" name="image" type="file"
                class="form-control @error('image') is-invalid @enderror">
            @error('image')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            <div class="pt-2"><button class="btn btn-primary">Сохранить</button></div>
        </form>

    </div>
@endsection
