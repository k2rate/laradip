<ul class="list-group list-group-flush basket-list">
    @foreach ($bucket as $key => $basket_product)
        @include('includes.basket.product')      
    @endforeach
</ul>
