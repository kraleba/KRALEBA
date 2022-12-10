$(document).ready(function () {
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('#template_gender_type, #template_gender_type1').click(function () {
        if ($(this).is(':checked')) {
            $("#template_parent_box").show();
        }
    });

    const template_values = [];
    let index = 0;
    let numberOfTextile = 1;
    let child_photos = null;

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

        /*verify if form is valid and return data*/
        let form_customer = verifyIfChildFormIsCompletedCorrect(categories_id);

        if (form_customer) {
            emptyTheChildrenFilledFields(categories_id);

            if (index === parseInt($('.number_of_child').val()) - 1) {
                $('#salve_parent_product').show();
                $('.child-validate').hide();
            }

            if (form_customer.length > 0) {

                template_values[index] = {
                    'form_customer': form_customer,

                };

                numberOfChildrenGenerated();

                ++index;

                $('#child_photos' + (template_values.length)).hide()
                $('#child_photos' + (template_values.length + 1)).show()
            }
        }
    });

    function verifyIfChildFormIsCompletedCorrect(categories_id) {
        let form_customer = [];
        let index = true;
        for (let i = 0, j = 0; i < categories_id.length + numberOfTextile; ++i) {

            if ($('#check_if_is_checked' + i).is(":checked") !== false) {

                form_customer[j] = {
                    'customer_id': getFieldValueByFieldClassSelect2(i, 'customer', 'id'),
                    'category_id': getFieldValueByFieldClassSelect2(i, 'customer', 'category_id'),
                    'product_name': getFieldValueByFieldClassSelect2(i, 'product_name', 'text'),
                    'custom_code': getFieldValueByFieldClassSelect2(i, 'custom_code', 'text'),
                    'bill_date': getFieldValueByFieldClassSelect2(i, 'bill_date', 'text'),
                    'bill_number': getFieldValueByFieldClassSelect2(i, 'bill_number', 'text'),
                    'amount': $('#amount' + i).val(),
                }

                $.ajax({
                    url: "/admin/template_child_validator",
                    type: 'GET',
                    data: {
                        form_customer: form_customer[j],
                    },
                    dataType: "json",
                    async: false,

                    success: function (data) {
                        if (!data) {
                            index = false;
                        }

                    },

                });

                if (!index || !form_customer[j]['amount']) {
                    return false;
                }

                ++j
            }
        }
        return form_customer;
    }

    $(".child-salve").click(function () {

        let template_child = {
            'product_name': $('#template_name').val(),
            'photos': child_photos,
        }

        $('#categories_template_child').val(JSON.stringify(template_values));
        $('#product_template_child').val(JSON.stringify(template_child));

    });

    $('.generate-template-children-form').click(function () {

        //validate if required fields is implemented.
        let validator = validateTemplateFields();
        if (!validator) {
            return false;
        }
        //-----------------------------------------------
        $('.generate-template-children-form').hide();
        $('.categories_area').show();
        $('#number_of_child').attr('readonly', true);
        $('#template_name').attr('readonly', true);

        let categories = $('.categories_area').attr('categories');
        numberOfChildrenGenerated();

        if (categories) {
            categories = JSON.parse(categories);
        } else {
            return;
        }

        $.each(categories, function (key, value) {
            categoriesFormGenerated(value);
        });
        // -------Generate photos input ______ //
        photos_fields_generate()

        $('#child_photos' + (template_values.length + 1)).show()

    });

    // add new form for textile
    $('#add_mote_items').click(function () {

        let number_of_extra_items = $('#child_number_of_extra_items').val();
        let category = [];

        if (number_of_extra_items > 0) {
            $('#add_more_items_box').hide();
        }

        for (let i = 2; i < parseInt(number_of_extra_items) + 2; ++i) {

            category = {
                id: 8 + i,
                name: 'Materii prime' + (i)
            };
            ++numberOfTextile;
            categoriesFormGenerated(category, 8);
        }

    });

    //children form
    function categoriesFormGenerated(category, custom_category_id) {

        if (!category) {
            return;
        }

        if (!custom_category_id) {
            custom_category_id = category['id'];
        }

        $("#template_child_form").append(
            '<div class="">' +
            '<input type="checkbox" id="check_if_is_checked' + category['id'] + '" ' +
            'category_id="' + custom_category_id + '" position_id="' + category['id'] + '" class="checkbox_customer_category"> ' + category["name"] +
            '</div>' +

            '<div class="form-control show_form_if_is_checked_' + category['id'] + '"  id="child-form-box" ' +
            'category_id="' + custom_category_id + '" ' +
            'position_id="' + category['id'] + '" ' + 'style="display: none">' +

            '<div class="form-group">' +
            '<label class="agile-label" for="customer">Furnizor</label>' +
            '<select class="form-control customer' + category['id'] + '" style="width: 200px;"> </select>' +
            '</div>' +

            '<div class="form-group">' +
            '<label>Articol Name</label>' +
            '<select class="form-control product_name' + category['id'] + '" style="width: 200px;"> </select>' +
            '</div>' +

            '<div class="form-group">' +
            '<label>Custom Code</label>' +
            '<select class="form-control custom_code' + category['id'] + '" style="width: 200px;"> </select>' +
            '</div>' +

            '<div class="form-group">' +
            '<label>Data Facturarii</label>' +
            '<select class="form-control bill_date' + category['id'] + '" style="width: 200px;"> </select>' +
            '</div>' +

            '<div class="form-group">' +
            '<label>Numarul Facturii</label>' +
            '<select class="form-control bill_number' + category['id'] + '" style="width: 200px;"> </select>' +
            '</div>' +

            '<div class="form-group">' +
            '<label>Cantitatea</label>' +
            '<input type="number" class="" id="amount' + category['id'] + '"/>' +
            '</div>' +
            '</div>'
        );

        searchCustomers(category['id'], custom_category_id);
        searchWareNameOrCustomCode('product_name', category['id'], custom_category_id, 'product_name');
        searchWareNameOrCustomCode('custom_code', category['id'], custom_category_id, 'custom_code');
        searchBillDateOrBillNumber('bill_date', category['id'], custom_category_id, 'bill_date');
        searchBillDateOrBillNumber('bill_number', category['id'], custom_category_id, 'bill_number');

    }

    /*search WARE PRODUCT NAME or CUSTOM CODE*/
    function searchWareNameOrCustomCode(item_class, items_index, category_id, row_name) {

        $("." + item_class + items_index).select2({
            ajax: {
                url: "/admin/search_ware_name",
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {

                    let product_name_selected = null;
                    if (row_name !== 'product_name') {
                        product_name_selected = getFieldValueByFieldClassSelect2(items_index, 'product_name', 'text')
                    }

                    return {
                        _token: CSRF_TOKEN,
                        search: params.term,
                        customer_id: getFieldValueByFieldClassSelect2(items_index, 'customer', 'id'),
                        category_id: category_id,
                        product_name_selected: product_name_selected,
                        row_name: row_name,

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

    /*search ware BILL DATE or BILL NUMBER*/
    function searchBillDateOrBillNumber(item_class, items_index, category_id, row_name) {

        $("." + item_class + items_index).select2({
            ajax: {
                url: "/admin/bills_autocomplete",
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        search: params.term,
                        customer_id: getFieldValueByFieldClassSelect2(items_index, 'customer', 'id'),
                        category_id: category_id,
                        product_name_selected: getFieldValueByFieldClassSelect2(items_index, 'product_name', 'text'),
                        ware_custom_code: getFieldValueByFieldClassSelect2(items_index, 'custom_code', 'text'),
                        bill_date: getFieldValueByFieldClassSelect2(items_index, 'bill_date', 'text'),
                        row_name: row_name,

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

    $('#template_child_form').on('click', '.checkbox_customer_category', function () {

        let position_id = $(this).attr('position_id');
        if ($(this).is(':checked')) {
            $('#template_child_form').children('.show_form_if_is_checked_' + position_id).show();
        } else {
            $('#template_child_form').children('.show_form_if_is_checked_' + position_id).hide();

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

    /*generates the number of children created and the maximum number of children*/
    function numberOfChildrenGenerated() {
        let number_of_child = template_values.length + 1 + ' / ' + $('.number_of_child').val();

        $('.number-of-children-area').html(number_of_child);

    }

    function emptyTheChildrenFilledFields(categories_id) {

        for (let i = 0; i < categories_id.length + numberOfTextile; ++i) {
            $('#check_if_is_checked' + i).prop("checked", false);
            $(".show_form_if_is_checked_" + i).hide();
            $(".customer" + i).select2('val', 'All');
            $(".product_name" + i).select2('val', 'All');
            $(".custom_code" + i).select2('val', 'All');
            $(".bill_date" + i).select2('val', 'All');
            $(".bill_number" + i).select2('val', 'All');
            $('#amount' + i).val('');
        }
    }

    function photos_fields_generate() {
        let child_photos = '';
        for (let i = 1; i <= $('.number_of_child').val(); ++i) {
            child_photos +=
                '<div style="display: none" id="child_photos' + i + '">' +
                '   <input type="file" id="template_photo1' + i + '" name="template_photo1' + i + '">' +
                '   <input type="file" id="template_photo2' + i + '" name="template_photo2' + i + '">' +
                '   <input type="file" id="template_photo3' + i + '" name="template_photo3' + i + '">' +
                '</div>'
        }
        console.log('teat');
        $('#photos_area').html(child_photos);
    }

});


