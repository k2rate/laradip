@extends('layouts.app')

@section('content')
    <div class="container">

        @if ($status == 'confirmed')
            <x-modal title="Заказ оформлен" id="exampleModal">
                <p>Ваш заказ оформлен. По прибытию курьер позвонит на ваш номер телефона при необходимости.</p>
            </x-modal>
        @endif


        <x-form route="bucket.checkoutSubmit" method="POST">
            <h2>Оформление заказа</h2>

            <div class="row">
                <div class="col-lg-6 col-sm-12 p-2">
                    <x-card title="Детали заказа">
                        <div class="row g-3">
                            <div class="col-12">
                                <x-input name="name" placeholder="Имя и/или фамилия" required></x-input>
                            </div>

                            <div class="col-12">
                                <x-input name="address" class="address-field" required readonly
                                    placeholder="Адрес доставки">
                                </x-input>
                            </div>

                            <div class="col-3">
                                <x-input name="kv" placeholder="Кв./Офис"></x-input>
                            </div>

                            <div class="col-3">
                                <x-input name="dm" placeholder="Домофон"></x-input>
                            </div>

                            <div class="col-3">
                                <x-input name="pd" placeholder="Подъезд"></x-input>
                            </div>

                            <div class="col-3">
                                <x-input name="et" placeholder="Этаж"></x-input>
                            </div>

                            <div class="col-12">
                                <x-input name="comment" placeholder="Комментарий к заказу"></x-input>
                            </div>

                            <div class="col-md-6">
                                <x-input name="email" placeholder="Эл. Почта"></x-input>
                            </div>

                            <div class="col-md-6">
                                <x-input name="phone" required placeholder="Номер телефона"></x-input>
                            </div>
                        </div>
                    </x-card>
                </div>


                <div class="col-lg-6 col-sm-12 p-2">
                    <x-card title="Оплата заказа">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <h4 class="fw-bold">Итого</h4>
                                <div class="row p-1">
                                    <div class="col-4">Стоимость заказа </div>
                                    <div class="col-3 fw-bold"> {{ $summary }} ₽</div>
                                </div>
                                <div class="row p-1">
                                    <div class="col-4">Доставка </div>
                                    <div class="col-3 fw-bold"> 0 ₽</div>
                                </div>
                                <div class="row p-1">
                                    <div class="col-4">Работа сервиса </div>
                                    <div class="col-3 fw-bold"> 0 ₽</div>
                                </div>
                            </div>

                            <div class="col-6">
                                <x-select name="payway" id="payway" label="Способ оплаты">
                                    <option selected value="0">Оплата при получении</option>
                                    <option value="1">Оплата картой</option>
                                </x-select>
                            </div>
                            <div class="col-6"></div>

                            <div class="col-12">
                                <div id="card-info" class="d-none">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <x-input name="cardnumber" placeholder="1111 2222 3333 4444">Номер кредитной
                                                карты</x-input>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <x-input name="expiry" placeholder="12/20">Срок действия</x-input>
                                        </div>
                                        <div class="col-md-3">
                                            <x-input name="cvv" placeholder="XXX">CVV</x-input>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12">
                                <x-submit class="btn-success">Оформить заказ</x-submit>
                                <span class="fw-bold ps-3 fs-5">{{ $summary }} ₽</span>
                            </div>

                        </div>
                    </x-card>
                </div>
            </div>



        </x-form>


        <x-modal title="Выбор адреса" id="map-modal" class="modal-lg">
            <x-input class="address-field" readonly>Адрес доставки</x-input>
            <div class="map m-0" id="map" style="height: 400px; width: 100%;">
            </div>
        </x-modal>

    </div>
@endsection


@push('scripts')
    @if ($status == 'confirmed')
        <script>
            $(document).ready(function() {
                $("#exampleModal").modal('show');
            });
        </script>
    @endif


    <script>
        document.getElementById("payway").onchange = changeListener;

        function changeListener() {
            var value = this.selectedIndex;

            if (value == 0) {
                $('#card-info').addClass('d-none');
            } else if (value == 1) {
                $('#card-info').removeClass('d-none');
            }
        }
    </script>

    <script src="https://enterprise.api-maps.yandex.ru/2.1/?lang=ru&apikey=c0d403ab-e5be-4049-908c-8122a58acf23"
        type="text/javascript"></script>

    <script>
        ymaps.ready(initMap);

        function initMap() {
            var geolocation = ymaps.geolocation;
            var coords;
            geolocation.get({
                provider: 'yandex',
                mapStateAutoApply: true
            }).then(function(result) {
                result.geoObjects.options.set('preset', 'islands#redCircleIcon');
                result.geoObjects.get(0).properties.set({
                    balloonContentBody: 'Мое местоположение'
                });


                coords = result.geoObjects.get(0).geometry.getCoordinates();
                initWithCoords(coords);

            }).catch(function() {
                geolocation.get({
                    provider: 'browser',
                    mapStateAutoApply: true
                }).then(function(result) {
                    coords = result.geoObjects.get(0).geometry.getCoordinates();
                    initWithCoords(coords);
                }).catch(function() {
                    coords = [37.385534, 55.584227];
                    initWithCoords(coords);
                });
            });
        }

        function initWithCoords(startCoords) {
            var myMap = new ymaps.Map('map', {
                center: startCoords,
                zoom: 9
            }, {
                searchControlProvider: 'yandex#search'
            });

            var myPlacemark = createPlacemark(startCoords);
            myMap.geoObjects.add(myPlacemark);

            myPlacemark.events.add('dragend', function() {
                getAddress(myPlacemark.geometry.getCoordinates());
            });

            // Listening for a click on the map
            myMap.events.add('click', function(e) {
                var coords = e.get('coords');
                myPlacemark.geometry.setCoordinates(coords);

                getAddress(coords);
            });

            // Creating a placemark
            function createPlacemark(coords) {
                return new ymaps.Placemark(coords, {}, {
                    preset: 'islands#violetDotIconWithCaption',
                    draggable: true
                });
            }

            function getAddress(coords) {
                ymaps.geocode(coords).then(function(res) {
                    var firstGeoObject = res.geoObjects.get(0);
                    var addrline = firstGeoObject.getAddressLine();
                    $('.address-field').val(addrline);
                });
            }
        }
    </script>


    <script>
        $('.address-field').click(function(e) {
            $('#map-modal').modal('show');
        })
    </script>
@endpush
