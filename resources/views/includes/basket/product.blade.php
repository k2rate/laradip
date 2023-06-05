
@php
    
    $product = $basket_product['object'];

    $remove_class = '';
    $append_class = '';
    
    if (isset($callback_id)) {
        $remove_class = 'basket_remove_' . $callback_id;
        $append_class = 'basket_append_' . $callback_id;
    }
    
@endphp

<li class="list-group-item border-top basket-product-{{ $product->id }}">
    <div class="row">
        <div class="col-6">
            <img class="img-fluid" style="max-height: 130px;" src="{{ $product->image }}">
        </div>
        <div class="col-6">
            <p>{{ $product->name }}</p>
            <p class="fw-bold">{{ $product->cost }} ₽</p>

            <div class="d-flex align-items-center">

                <x-form class="me-3 ajax-form-basket-remove {{ $remove_class }}" route="bucket.remove" method="POST"
                    product_id="{{ $product->id }}">
                    <input type="hidden" name="id", value="{{ $product->id }}">
                    <x-submit class="btn-danger product-btn">-</x-submit>
                </x-form>

                <p class="me-3 product-count-{{ $product->id }}" style="margin: 0;">
                    {{ $basket_product['count'] }}
                </p>

                <x-form class="ajax-form-basket-append {{ $append_class }}" route="bucket.add" method="POST"
                    product_id="{{ $product->id }}">
                    <input type="hidden" name="id", value="{{ $product->id }}">
                    <x-submit class="btn-success product-btn">+</x-submit>
                </x-form>
            </div>
        </div>

    </div>
</li>
