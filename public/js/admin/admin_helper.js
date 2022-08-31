/*---- Customers search ----*/

function searchCustomersSuggestions(request, response, category_id = null) {
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
                    label: obj.name,
                    id: obj.id,
                    category_id: category_id
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
