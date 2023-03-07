@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Добавление категории</h2>

        <form action="{{ route('admin.addCategory') }}" method="POST">
            @csrf
            <label for="name" class="col-sm-2 col-form-label">Название</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
            <button class="btn btn-primary mt-1" type="submit">Добавить категорию</button>
        </form>

        <hr>

        <h2>Категории</h2>

        <div class="row">
            @foreach ($categories as $category)
                <div class="col-md-4">
                    <h5 class="mt-1">{{ $category->name }}</h5>
                    <form action="{{ route('admin.deleteCategory') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $category->id }}">
                        <button class="btn btn-danger" type="submit">Удалить категорию</button>
                    </form>
                </div>
            @endforeach
        </div>

        <hr>

        <h2>Редактирование товаров</h2>
        @if ($products->count() == 0)
            <h3>Товаров не зарегистрировано</h3>
        @else
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset($product->image) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <a class="btn btn-primary" href="{{ route('admin.product', $product->id) }}">Редактировать</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>  
        @endif

        <hr>

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
                <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
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
