jquery(document).ready(function ($) {
    $("#ajax-form").submit(function () {
        const str = $(this).serialize();

        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: str,
            success: function (msg) {
                
            }
            
        });

    })
})