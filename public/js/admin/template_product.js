$(document).ready(function () {
    $('#template_gender_type, #template_gender_type1').click(function () {
        if ($(this).is(':checked')) {
            $("#template_parent_box").show();
        }
    });

    const template_values = [];
    let index = 0;
    let numberOfTextile = 1;
    let customer_id_selected = [];

    $(".child-validate").click(function () {

        let categories = JSON.parse($('.categories_area').attr('categories'));
        let categories_id = [];

        for (let i = 0; i < categories.length; ++i) {
            categories_id[i] = categories[i]['id'];
        }

        let categoryLength = categories_id.length + numberOfTextile;
        for (let i = categories_id.length; i < categoryLength; ++i) {
            categories_id[i] = i;
        }

        let form_customer = [];
        for (let i = 0, j = 0; i < categories_id.length + numberOfTextile; ++i) {


            if ($('#check_if_is_checked' + categories_id[i]).is(":checked") !== false) {
                form_customer[j] = {
                    'customer_name': $('#customer' + categories_id[i]).val(),
                    'customer_id': customer_id_selected['category_id' + categories_id[i]],
                    'product_name': $('#product_name' + categories_id[i]).val(),
                    'custom_code': $('#custom_code' + categories_id[i]).val(),
                    'bill_number': $('#bill_number' + categories_id[i]).val(),
                    'bill_date': $('#bill_date' + categories_id[i]).val(),
                    'amount': $('#amount' + categories_id[i]).val(),
                    'category_id': categories_id[i]
                }

                $.ajax({
                    url: "/admin/template_child_validator",
                    type: 'GET',
                    data: {
                        form_customer: form_customer[j],
                    },
                    dataType: "json",
                    success: function (data) {
                        if(data) {
                            $('#check_if_is_checked' + categories_id[i]).prop("checked", false);
                            $(".show_form_if_is_checked_" + categories_id[i]).hide();
                            $('#customer' + categories_id[i]).val('');
                            $('#product_name' + categories_id[i]).val('');
                            $('#custom_code' + categories_id[i]).val('');
                            $('#bill_date' + categories_id[i]).val('');
                            $('#bill_number' + categories_id[i]).val('');
                            $('#amount' + categories_id[i]).val('');
                        }
                    },

                });

                ++j
            }

        }

        if (index === parseInt($('.number_of_child').val())) {
            $('#salve_parent_product').show();
            $('.child-validate').hide();
        }

        if (form_customer.length > 0) {
            template_values[index] = form_customer;
            ++index;
        }

    });


    $(".child-salve").click(function () {
        let number_of_child = $('.number_of_child').val();

        let template_child = {
            'template_child_photo': '22',
            // 'number_of_child': $('.number_of_child').val(),
            'product_name': $('#template_name').val(),
        }

        // console.log(template_values);

        $('#categories_template_child').val(JSON.stringify(template_values));
        $('#product_template_child').val(JSON.stringify(template_child));

    });

    $('.generate-template-children-form').click(function () {

        //validate if required fields is implemented.
        let validator = validateTemplateFields();
        if (!validator) {
            // return false;
        }


        $('.generate-template-children-form').hide();
        $('.categories_area').show();
        $('#number_of_child').attr('readonly', true);
        $('#template_name').attr('readonly', true);


        let categories = $('.categories_area').attr('categories');

        if (categories) {
            categories = JSON.parse(categories);
        } else {
            return;
        }

        for (let i = 0; i < categories.length; ++i) {
            categoriesFormGenerated(categories[i]);
        }

    });

    // add new form for textile
    $('#add_more_textile_btn').on('click', '.add-more-textile', function () {

        let category = {
            id: 8 + numberOfTextile,
            name: 'Textile' + (numberOfTextile + 1)
        };

        ++numberOfTextile;
        categoriesFormGenerated(category);

    });

    function categoriesFormGenerated(category) {

        if (!category) {
            return;
        }

        $("#template_child_form").append(
            '<div class="">' +
            '<input type="checkbox" id="check_if_is_checked' + category['id'] + '" ' +
            'category_id="' + category['id'] + '" class="checkbox_customer_category"> ' + category["name"] +
            '</div>' +

            '<div class="form-control show_form_if_is_checked_' + category['id'] + '" category_id="' + category["id"] + '" id="child-form-box" ' + 'style="display: none">' +
            '<div class="form-group">' +
            '<label class="agile-label" for="customer">Furnizor</label>' +
            '<input name="customer" class="form-control autocomplete_customer" id="customer' + category['id'] + '"/>' +
            '</div>' +

            '<div class="form-group">' +
            '<label>Articol Name</label>' +
            '<input name="product_name" class="form-control autocomplete_article_name" id="product_name' + category['id'] + '"/>' +
            '</div>' +

            '<div class="form-group">' +
            '<label>Custom Code</label>' +
            '<input name="custom_code" class="form-control autocomplete_custom_code" id="custom_code' + category['id'] + '"/>' +
            '</div>' +

            '<div class="form-group">' +
            '<label>Data Facturarii</label>' +
            '<input name="bill_date" class="form-control bill_date" id="bill_date' + category['id'] + '"/>' +
            '</div>' +

            '<div class="form-group">' +
            '<label>Numarul Facturii</label>' +
            '<input name="bill_number" class="form-control bill_number" id="bill_number' + category['id'] + '"/>' +
            '</div>' +

            '<div class="form-group">' +
            '<label>Cantitatea</label>' +
            '<input type="number" class="form-control" name="amount" id="amount' + category['id'] + '"/>' +
            '</div>'
        );

        /*search customers*/
        $(".autocomplete_customer").autocomplete({
            source: function (request, response) {
                let category_id = getCustomer_category_id_by_child_id($(this.element).prop("id"));
                if (!category_id) {
                    return false;
                }
                searchCustomersSuggestions(request, response, category_id);
            },
            select: function (event, ui) {
                customer_id_selected['category_id' + ui.item.category_id] = ui.item.id;
            },
            minLength: 0
        });

        /*search ware name*/
        $(".autocomplete_article_name").autocomplete({
            source: function (request, response) {
                let row_name = $(this.element).prop("name");
                let category_id = getCustomer_category_id_by_child_id($(this.element).prop("id"));

                if (!row_name || !category_id) {
                    return false;
                }

                searchWareByCustomerId(request, response, row_name, customer_id_selected ['category_id' + category_id]);
            },
            minLength: 0
        });

        /*search custom code from ware*/
        $(".autocomplete_custom_code").autocomplete({
            source: function (request, response) {

                let category_id = getCustomer_category_id_by_child_id($(this.element).prop("id"));
                let product_name_selected = $('#product_name' + category_id).val();
                let row_name = $(this.element).prop("name");
                if (!product_name_selected || !row_name) {
                    return false;
                }

                searchWareByCustomerId(request, response, row_name, customer_id_selected['category_id' + category_id], product_name_selected);
            },
            minLength: 0
        });

        /* search bill date by customer_id, ware name, custom code*/
        $(".bill_date").autocomplete({
            source: function (request, response) {

                let category_id = getCustomer_category_id_by_child_id($(this.element).prop("id"));
                let row_name = $(this.element).prop("name");
                let product_name_selected = $('#product_name' + category_id).val();
                let ware_custom_code = $('#custom_code' + category_id).val();

                if (!category_id || !row_name || !customer_id_selected['category_id' + category_id] || !product_name_selected || !ware_custom_code) {
                    return false;
                }

                let suggestions_criteria = {
                    row_name: row_name,
                    customer_id: customer_id_selected['category_id' + category_id],
                    ware_product_name_selected: product_name_selected,
                    ware_custom_code: ware_custom_code
                }

                searchBillsDataByCustomerId(request, response, suggestions_criteria);
            },
            minLength: 0
        });

        /*bill number*/
        $(".bill_number").autocomplete({
            source: function (request, response) {

                let category_id = getCustomer_category_id_by_child_id($(this.element).prop("id"));
                let row_name = $(this.element).prop("name");
                let product_name_selected = $('#product_name' + category_id).val();
                let ware_custom_code = $('#custom_code' + category_id).val();
                let bill_data = $('#bill_date' + category_id).val();

                if (!category_id || !row_name || !customer_id_selected['category_id' + category_id] || !product_name_selected || !ware_custom_code || !bill_data) {
                    return false;
                }

                let suggestions_criteria = {
                    row_name: row_name,
                    customer_id: customer_id_selected['category_id' + category_id],
                    ware_product_name_selected: product_name_selected,
                    ware_custom_code: ware_custom_code,
                    bill_data: bill_data
                }

                searchBillsDataByCustomerId(request, response, suggestions_criteria);
            },
            minLength: 0
        });
    }

    $('#template_child_form').on('click', '.checkbox_customer_category', function () {

        let category_id = $(this).attr('category_id');
        if ($(this).is(':checked')) {
            $('#template_child_form').children('.show_form_if_is_checked_' + category_id).show();
        } else {
            $('#template_child_form').children('.show_form_if_is_checked_' + category_id).hide();

        }
    });

    function validateTemplateFields() {
        let validator = [];
        validator[0] = $('#parent_template').validate().element("#marketing_category_id");
        validator[1] = $('#parent_template').validate().element("#category");
        validator[2] = $('#parent_template').validate().element("#theme");
        validator[3] = $('#parent_template').validate().element("#styles");
        validator[4] = $('#parent_template').validate().element("#occasion");
        validator[5] = $('#parent_template').validate().element("#seasonality");
        validator[6] = $('#parent_template').validate().element("#author");
        validator[7] = $('#parent_template').validate().element("#collection");
        validator[8] = $('#parent_template').validate().element("#cuffs");
        validator[9] = $('#parent_template').validate().element("#slits");
        validator[10] = $('#parent_template').validate().element("#sleeves");
        validator[11] = $('#parent_template').validate().element("#pockets");
        validator[12] = $('#parent_template').validate().element("#stitching");
        validator[13] = $('#parent_template').validate().element("#seams_colour");
        validator[14] = $('#parent_template').validate().element("#template_buttons");
        validator[15] = $('#parent_template').validate().element("#interlining");
        validator[16] = $('#parent_template').validate().element("#number_of_child");
        validator[17] = $('#parent_template').validate().element("#template_name");

        for (let i = 0; i < validator.length; ++i) {
            if (!validator[i]) {
                return false;
            }
        }
        return true;
    }

    function getCustomer_category_id_by_child_id(input_id) {
        return $('#' + input_id).parent().parent().attr("category_id");
    }

});


