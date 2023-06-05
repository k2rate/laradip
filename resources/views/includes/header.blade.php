<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top" id="header">
    <div class="container">

        <div class="logo-block me-3">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <img src="{{ asset('img/logo.png') }}" class="me-2" width="30" alt="">
                <span class="fs-5">EatShop</span>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">О нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalog') }}">Каталог</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('where') }}">Контакты</a>
                </li>


            </ul>

            <ul class="navbar-nav ms-auto">

                <style>
                    #bucket-hover:hover {
                        cursor: pointer;
                    }
                </style>

                <li class="nav-item">
                    <span class="nav-link p-0" id="bucket-hover" onclick="showBasket();">
                        <div class="btn btn-success position-relative">
                            <img src="{{ asset('img/basket.png') }}" style="height: 21px;" alt="">
                            <span class="p-1">Корзина</span>
                            
                            <span id="basket-count"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-success">
                                {{ $productsInBucketCount }}
                            </span>
                        </div>
                    </span>
                </li>


            </ul>
        </div>

    </div>
</nav>

<x-modal title="Корзина" id="basket-modal">

    <x-form class="form-ky mb-1" route="bucket.checkout">
        <x-submit class="btn-success w-100">Оформить заказ</x-submit>
    </x-form>


    @include('includes.basket.list')
</x-modal>

@push('scripts')
    <script>
        function showBasket() {
            $("#basket-modal").modal('show');
        }
    </script>

    <script>
        let header = document.querySelector('#header');
        let width = header.offsetWidth;
        let height = header.offsetHeight;

        let main = document.querySelector('main');
        main.style = 'margin-top: ' + height + 'px;';
    </script>
@endpush
