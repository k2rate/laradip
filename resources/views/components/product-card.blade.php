@props(['modal_id', 'img_height' => '210px'])



<x-card {{ $attributes->class(['mb-3']) }}>
    <div style="height: {{ $img_height }};" @isset($modal_id) onclick="$('#{{ $modal_id }}').modal('show');" @endisset>
        <img  class="img-fluid d-block mx-auto" src="{{ asset($product->image) }}">
    </div>

    <p class="card-text" style="min-height: 45px">{{ $product->name }}</p>
    <p class="card-text fw-bold">{{ $product->cost }} ₽</p>

    {{ $slot }}


</x-card>
