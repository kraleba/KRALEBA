/*Composition search*/
$(document).ready(function () {
    let row_name;
    $(".find_textiles_composition, .find_material, .find_textiles_design, .find_textiles_color, .find_textiles_structure, .find_textiles_weaving, .find_textiles_finishing, .find_textiles_rating").click(function () {
        row_name = $(this).attr('row_name');

    });

    $(".find_textiles_composition, .find_material, .find_textiles_design, .find_textiles_color, .find_textiles_structure, .find_textiles_weaving, .find_textiles_finishing, .find_textiles_rating").autocomplete({
        source: function (request, response) {

            $.ajax({
                url: "/admin/find_textiles_filters",
                dataType: "json",
                type: 'GET',
                data: {
                    term: request.term,
                    row_name: row_name
                },
                success: function (data) {
                    var resp = $.map(data, function (obj) {
                        return obj.name;
                    });
                    response(resp);
                }
            });
        },
        minLength: 0
    });

});

