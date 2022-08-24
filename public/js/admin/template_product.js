$(document).ready(function () {
    $('#template_gender_type, #template_gender_type1').click(function () {
        if ($(this).is(':checked')) {
            $("#template_parent_box").show();
        }
    });

    const template_values = [];
    let index = 1;

    $(".child-validate").click(function () {

        let categories = $('.categories_area').attr('categories');
        categories = JSON.parse(categories);

        let form_customer = [];
        for (let i = 0, j = 0; i < categories.length; ++i) {

            if ($('#check_if_is_checked' + categories[i]['id']).is(":checked")) {
                form_customer[j] = {
                    'customer_id': $('#customer' + categories[i]['id']).val(),
                    'custom_code': $('#custom_code' + categories[i]['id']).val(),
                    'bill_date': $('#bil_date' + categories[i]['id']).val(),
                    'bill_number': $('#bill_number' + categories[i]['id']).val(),
                    'amount': $('#amount' + categories[i]['id']).val(),
                    'category_id': categories[i]['id']
                }

                $('#check_if_is_checked' + categories[i]['id']).prop("checked", false);
                $("#show_category_by_id" + categories[i]['id']).hide();

                ++j
            }

            $('#customer' + categories[i]['id']).val('');
            $('#custom_code' + categories[i]['id']).val('');
            $('#bil_date' + categories[i]['id']).val('');
            $('#bill_number' + categories[i]['id']).val('');
            $('#amount' + categories[i]['id']).val('');

        }

        console.log($('.number_of_child').val());
        console.log(index);
        if (index === parseInt($('.number_of_child').val())) {
            console.log('asdfasdfasdfasdfasdfasd');
            $('#salve_parent_product').show();
            $('.child-validate').hide();
        }

        if (form_customer.length > 0) {
            template_values[index] = form_customer;
            ++index;
        }

    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
            return false;
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

    let numberOfTextile = 2;

    // add new form for textile
    $('#add_more_textile_btn').on('click', '.add-more-textile', function () {
        let category = {
            id: 8 + numberOfTextile,
            name: 'Textile' + numberOfTextile
        };

        ++numberOfTextile;
        categoriesFormGenerated(category);
    });


    $('#template_child_form').on('click', '.checkbox_customer_category', function () {

        let category_id = $(this).attr('category_id');
        if ($(this).is(':checked')) {
            $('#template_child_form').children('.show_form_if_is_checked_' + category_id).show();
        } else {
            $('#template_child_form').children('.show_form_if_is_checked_' + category_id).hide();

        }
    });

    function categoriesFormGenerated(category) {

        if (!category) {
            return;
        }

        $("#template_child_form").append('<div class="appm"></div>');
        $("#template_child_form").append('<input type="checkbox" category_id="' + category['id'] + '" class="checkbox_customer_category"> ' + category['name']);

        $("#template_child_form").append('<div class="form-control show_form_if_is_checked_' + category['id'] + '" style="display: none">' +
            '<div class="">' +
            '<label class="agile-label" for="customer">Furnizor</label>' +
            '<br>' +
            '<input name="customer" class="" id="customer{{$category->id}}"/>' +
            '</div>' +

            '<div class="">' +
            '<label>Custom Code</label>' +
            '<br>' +
            '<input name="bill_number" class="" id="custom_code{{$category->id}}"/>' +
            '</div>' +

            '<div class="">' +
            '<label>Data Facturarii</label>' +
            '<br>' +
            '<input name="bill_date" class="" id="bil_date{{$category->id}}"/>' +
            '</div>' +

            '<div class="">' +
            '<label>Numarul Facturii</label>' +
            '<br>' +
            '<input name="bill_number" class="" id="bill_number{{$category->id}}"/>' +
            '</div>' +

            '<div class="">' +
            '<label>Cantitatea</label>' +
            '<br>' +
            '<input type="number" class="" name="amount" id="amount{{$category->id}}"/>' +
            '</div>'
        );
    }


    function validateTemplateFields() {
        let validator = [];
        validator[0] = $('#parent_template').validate().element("#marketing_category_id");
        validator[1] = $('#parent_template').validate().element("#style_category_id");
        validator[2] = $('#parent_template').validate().element("#cuffs");
        validator[3] = $('#parent_template').validate().element("#slits");
        validator[4] = $('#parent_template').validate().element("#sleeves");
        validator[5] = $('#parent_template').validate().element("#pockets");
        validator[6] = $('#parent_template').validate().element("#stitching");
        validator[7] = $('#parent_template').validate().element("#seams_colour");
        validator[8] = $('#parent_template').validate().element("#template_buttons");
        validator[9] = $('#parent_template').validate().element("#interlining");
        validator[10] = $('#parent_template').validate().element("#number_of_child");
        validator[11] = $('#parent_template').validate().element("#template_name");

        for (let i = 0; i < validator.length; ++i) {
            if (!validator[i]) {
                return false;
            }
        }
        return true;
    }

});


