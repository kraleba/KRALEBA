$(document).ready(function () {
    $('.categories-box').click(function () {
        let category_id = $(this).attr('category_id');

        if ($(this).is(':checked')) {
            $("#show_category_by_id" + category_id).show();

        } else {
            $("#show_category_by_id" + category_id).hide();


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

        // console.log(index);
        // if (parseInt(number_of_child) === index) {
        //     $.ajax({
        //         url: 'create_child_templates',
        //         method: "post",
        //         data: {
        //             template_values: template_values,
        //         },
        //     });
        // }
    });

});


