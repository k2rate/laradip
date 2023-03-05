
jQuery(document).ready(function ($) {

    $(".ajax-form-append").submit(function (e) {
        e.preventDefault();

        let sel = "#card-" + $(this).attr("index");
        const str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: str,
            success: function (msg) {

                let error = msg['error'];
                if (error === 'success') {
                    $(".state").html('');

                    let prodc = $(sel).find('#product-count');
                    let old = parseInt(prodc.html());
                    old += 1;
                    prodc.html(old);

                }
                else {
                    $(".state").fadeOut(1).html('<div class="alert alert-danger" role="alert">Ошибка: ' + error + '</div>').fadeIn(50);
                }

            },


        });
    });

    $(".ajax-form-remove").submit(function (e) {
        e.preventDefault();

        let sel = "#card-" + $(this).attr("index");
        const str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: str,
            success: function (msg) {
                let prodc = $(sel).find('#product-count');
                let old = parseInt(prodc.html());
                old -= 1;

                if (old > 0) {
                    prodc.html(old);
                }
                else {
                    $(sel).remove();
                }



            },


        });
    });

    $(".ajax-form").submit(function (e) {
        e.preventDefault();
        const str = $(this).serialize();

        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: str,
            success: function (msg) {
                let error = msg['error'];
                if (error === 'success') {
                    $(".state").fadeOut(1).html('<div class="alert alert-success" role="alert">Добавлено в корзину</div>').fadeIn(50);
                }
                else {
                    $(".state").fadeOut(1).html('<div class="alert alert-danger" role="alert">Ошибка: ' + error + '</div>').fadeIn(50);
                }

            }

        });
    });


});

