/*---- Customers search ----*/

/*search customers*/
let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

function searchCustomers(items_index, category_id) {
    // Initialize select2

    $(".customer" + items_index).select2({
        ajax: {
            url: "/admin/customers_autocomplete",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                let subcategory_id = false;
                let subcategory = $('.subcategories' + category_id).select2('data');
                if(subcategory[0]) {
                    subcategory_id = subcategory[0].id;
                }

                return {
                    _token: CSRF_TOKEN,
                    search: params.term,
                    category_id: category_id,
                    subcategory_id: subcategory_id
                };
            },
            processResults: function (response) {
                return {
                    results: response
                };
            },
            cache: true

        },

    });

}

/*return data selected from select2 if exists*/
function getFieldValueByFieldClassSelect2(position_index, field_class_name, field_item) {

    try {
        return $("." + field_class_name + position_index).select2('data')[0][field_item]
    } catch (e) {
        return '';
    }

}

function take_categories() {

    let categories = '';

    $.ajax({
        url: "/admin/take_categories",
        type: 'GET',
        dataType: "json",
        async: false,

        success: function (data) {
            categories = data;
        },

    });
    return categories;
}


/*--------------*/
function searchCustomersSuggestions(request, response, category_id = null, position_id = null) {
    $.ajax({
        url: "/admin/customers_autocomplete",
        type: 'GET',
        data: {
            term: request.term,
            category_id: category_id
        },
        dataType: "json",
        success: function (data) {

            var resp = $.map(data, function (obj) {
                return {
                    label: obj.text,
                    id: obj.id,
                    category_id: category_id,
                    position_id: position_id
                };
            });

            response(resp);
        },

    });
}

/*---- Customers search ----*/

/*---- Search Bill data after Customer ID*/
function searchBillsDataByCustomerId(request, response, suggestions_criteria) {

    $.ajax({
        url: "/admin/bills_autocomplete",
        type: 'GET',
        data: {
            term: request.term,
            customer_id: suggestions_criteria.customer_id,
            row_name: suggestions_criteria.row_name,
            ware_custom_code: suggestions_criteria.ware_custom_code,
            ware_product_name_selected: suggestions_criteria.ware_product_name_selected,
            bill_data: suggestions_criteria.bill_data,
        },
        dataType: "json",
        success: function (data) {

            var resp = $.map(data, function (obj) {

                if (obj.bill_date) {
                    return {
                        label: obj.bill_date,
                    };
                }

                if (obj.bill_number) {
                    return {
                        label: obj.bill_number,
                    };
                }
            });

            response(resp);
        },

    });
}

/*---- Search Bill data after Customer ID END ----*/

/*---- Ware name autocomplete ----*/
function searchWareByCustomerId(request, response, row_name, customer_id, category_id, product_name_selected) {
    $.ajax({
        url: "/admin/search_ware_name",
        type: 'GET',
        data: {
            term: request.term,
            customer_id: customer_id,
            row_name: row_name,
            category_id: category_id,
            product_name_selected: product_name_selected,
        },
        dataType: "json",
        success: function (data) {

            var resp = $.map(data, function (obj) {
                if (obj.product_name) {
                    return {
                        label: obj.product_name,
                    };

                }

                if (obj.custom_code) {
                    return {
                        label: obj.custom_code,
                    };

                }


            });

            response(resp);
        },

    });
}

/*---- Ware name autocomplete END----*/

/*--- SEARCH SUBCATEGORYES FOR CATEGORY START ---*/
$(document).ready(function () {
    $("#find_subcategories_by_category_id").autocomplete({
        source: function (request, response) {
            let category_id = $('#category_select').find(":selected").val();
            $.ajax({
                url: "/admin/subcategories_for_category",
                type: 'GET',
                data: {
                    term: request.term,
                    category_id: category_id
                },
                dataType: "json",
                success: function (data) {
                    var resp = $.map(data, function (obj) {
                        return {
                            label: obj.name,
                            id: obj.id,
                        };
                    });
                    response(resp);
                },

            });
        },
        minLength: 0
    });
});
/*--- SEARCH SUBCATEGORYES FOR CATEGORY END ---*/
