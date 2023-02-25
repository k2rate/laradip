@extends('layouts.app')

<?php use App\Models\Tovar; ?>

@section('content')
    <div class="container">
        <h1>Корзина</h1>
        @foreach($bucket as $tovar_id)
        <?php $tovar = Tovar::find($tovar_id); ?>
        <?php if($tovar): ?>
        <p class="fs-3">{{ $tovar->desc }} Цена: {{ $tovar->cost }} Модель: {{ $tovar->model }} </p>
        <?php endif; ?>
        @endforeach
    </div>
@endsection
