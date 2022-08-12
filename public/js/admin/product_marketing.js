$(document).ready(function () {
   /*find template by product name*/
    $("#find_product_name").autocomplete({
        source: function (request, response) {

            $.ajax({
                url: "/admin/find_market_product",
                data: {
                    term: request.term
                },
                dataType: "json",
                success: function (data) {

                    var resp = $.map(data, function (obj) {
                        return obj.product_name;
                    });

                    response(resp);
                }
            });
        },
        minLength: 0
    });
    /*find template by product name*/

});
