@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Редактирование товаров</h2>
        @if ($products->count() == 0)
            <h3>Товаров не зарегистрировано</h3>
        @else
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3">
                        <div class="product-preview">
                            <h4>{{ $product->name }}</h4>
                            <img src="{{ asset($product->image) }}" alt="" class="img-fluid">
                            <a href="{{ route('admin.product', $product->id) }}">Редактировать</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

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

                <label for="category" class="col-sm-2 col-form-label">Категория</label>
                <input id="category" name="category" type="text"
                    class="form-control @error('category') is-invalid @enderror">
                @error('category')
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
@endsection
