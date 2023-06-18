jQuery(document).ready(function ($) {

    function getBasketCount() {
        return parseInt($("#basket-count").html());
    }

    function setBasketCount(count) {
        $("#basket-count").html(count);
    }

    function incBasketCounter() {
        setBasketCount(getBasketCount() + 1);
    }

    function subBasketCounter() {
        setBasketCount(getBasketCount() - 1);
    }

    function appendSubmitCallback(e) {
        e.preventDefault();

        let productId = $(this).attr("product_id");
        let counterSelector = '.product-count-' + productId;

        const str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: str,
            success: function (msg) {
                let counter = $(counterSelector);
                let prevCount = parseInt(counter.html());
                let newCount = prevCount + 1;

                let error = msg['error'];

                if (error === 'success') {

                    if (msg['html']) {
                        $('.basket-list').append(msg['html']);

                        let callbackId = msg['callback_id'];

                        $(".basket_append_" + callbackId).submit(appendSubmitCallback);
                        $(".basket_remove_" + callbackId).submit(removeSumbitCallback);

                    } else {
                        counter.html(newCount);
                    }

                    incBasketCounter();
                }
                else {
                    $(".state").fadeOut(1).html('<div class="alert alert-danger" role="alert">Ошибка: ' + error + '</div>').fadeIn(50);
                }
            },
        });
    }

    function removeSumbitCallback(e) {
        e.preventDefault();

        let productId = $(this).attr("product_id");
        let counterSelector = '.product-count-' + productId;
        let basketProductSelector = '.basket-product-' + productId;

        const str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: str,
            success: function (msg) {

                let counter = $(counterSelector);
                let prevCount = parseInt(counter.html());
                let newCount = prevCount - 1;

                let error = msg['error'];
                if (error === 'success') {

                    if (msg['removed']) {
                        if (newCount > 0) {
                            counter.html(newCount);
                        }
                        else {
                            $(basketProductSelector).remove();
                        }

                        subBasketCounter();
                    }

                }
                else {
                    $(".state").fadeOut(1).html('<div class="alert alert-danger" role="alert">Ошибка: ' + error + '</div>').fadeIn(50);
                }
            },
        });
    }

    $(".ajax-form-basket-append").submit(appendSubmitCallback);
    $(".ajax-form-basket-remove").submit(removeSumbitCallback);
});

