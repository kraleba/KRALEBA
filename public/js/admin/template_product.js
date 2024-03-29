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
                $('#categories_form').hide();
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
        let form_is_completed = true;
        let verifi_if_category_is_checked = false;
        for (let i = 0, j = 0; i < categories_id.length + numberOfTextile; ++i) {

            if ($('#check_if_is_checked' + i).is(":checked") !== false) {

                verifi_if_category_is_checked = true;
                let subcategory_id = null;
                if (i < 8) {
                    subcategory_id = getFieldValueByFieldClassSelect2(i, 'subcategories', 'id');
                }

                form_customer[j] = {
                    'customer_id': getFieldValueByFieldClassSelect2(i, 'customer', 'id'),
                    'subcategory_id': subcategory_id,
                    'category_id': getFieldValueByFieldClassSelect2(i, 'customer', 'category_id'),
                    'ware_id': getFieldValueByFieldClassSelect2(i, 'product_name', 'id'),
                    'amount': $('#amount' + i).val()
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
                            form_is_completed = false;
                        }

                    },

                });

                let photo1 = $('#template_photo1' + (index + 1)).val();
                let photo2 = $('#template_photo2' + (index + 1)).val();
                let photo3 = $('#template_photo3' + (index + 1)).val();

                if ((!photo1 || !photo2 || !photo3) || (!form_is_completed || !form_customer[j]['amount'])) {
                    alert('Trebuie completate toate campurile pentru a putea valida!')
                    return false;
                }

                ++j
            }
        }

        if (!verifi_if_category_is_checked) {
            alert('Trebui selectata o categorie pentru a putea continua!')
        }

        return form_customer;
    }

    $(".child-salve").click(function () {
        $('#categories_template_child').val(JSON.stringify(template_values));
    });

    $('.generate-template-children-form').click(function () {

        //validate if required fields is implemented.
        let validator = validateTemplateFields();
        //if is false show warning
        // if (!validator) {
        //     return false;
        // }

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

    //children form
    function categoriesFormGenerated(category) {

        if (!category) {
            return;
        }
        // chech boxes and add remove buttons
        checkBoxCategories(category)
        // filters template
        catehoriesBoxItems(category['id'])
        // searchWareNameOrCustomCode('custom_code', category['id'], custom_category_id, 'custom_code');
        // searchBillDateOrBillNumber('bill_number', category['id'], custom_category_id, 'bill_number');

        $('#find_textiles_composition' + category['id'] +
            ', #find_material' + category['id'] +
            ', #find_textiles_design' + category['id'] +
            ', #find_textiles_color' + category['id'] +
            ', #find_textiles_structure' + category['id'] +
            ', #find_textiles_weaving' + category['id'] +
            ', #find_textiles_finishing' + category['id'] +
            ', #find_textiles_rating' + category['id']
        ).select2({
            allowClear: true,
            placeholder: "Search for a option",
            ajax: {
                url: "/admin/find_textiles_filters",
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        _token: CSRF_TOKEN,
                        term: params.term,
                        row_name: $(this).attr('row_name')
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

    function checkBoxCategories(category) {
        $("#template_child_form").append(
            '<div class="form-group col-xs-12 col-sm-12 col-md-12 checkbox-box">' +
            '   <input type="checkbox" id="check_if_is_checked' + category['id'] + '" value= "' + category['id'] + '" ' +
            '      "category_id="' + category['id'] + '" class="checkbox_customer_category"> ' + category["name"] +
            '   <div class="col-xs-12 col-sm-12 col-md-12 show_form_if_is_checked_' + category['id'] + '"  id="child-form-box" ' +
            '       category_id="' + category['id'] + '" ' +
            '       style="display:none">' +
            '   </div>' +
            '   <div class="form-group col-xs-12 col-sm-12 col-md-12 add-remove-categorie' + category['id'] + '" style="display:none">' +
            '       <br>' +
            '       <button type="button" class="form-group add-button" value="" id="amount' + category['id'] + '" />' +
            '           <i class="fas fa-plus"></i>' +
            '       </button>' +
            '       <button type="button" class="delete-button">' +
            '           <i class="fas fa-minus"></i>' +
            '       </button>' +
            '   </div>' +
            '</div>'
        );

    }

    function catehoriesBoxItems(category_id) {

        if (category_id != 8) {
            $(".show_form_if_is_checked_" + category_id).append(
                '<div class="form-group col-xs-12 col-sm-12 col-md-12 required">' +
                '<label>Subcategorii</label>' +
                '   <br>' +
                '<select class="form-control subcategories test' + category_id + '" style="width: 70%;"> </select>' +
                '</div>'
            );
        }

        if (category_id >= 8) {
            $(".show_form_if_is_checked_" + category_id).append(

                '<div class="form-group col-xs-12 col-sm-12 col-md-12">' +
                '   <label>Composition</label>' +
                '<br>' +
                '   <select id="find_textiles_composition' + category_id + '" row_name="composition"' +
                '       class="form-control" style="width: 70%;">' +
                '   </select> ' +
                '</div>' +

                '<div class="form-group col-xs-12 col-sm-12 col-md-12">' +
                '   <strong>Material</strong>' +
                '   <br>' +
                '   <select id="find_material' + category_id + '" row_name="material"' +
                '       placeholder="-- Select the Material --"' +
                '       class="form-control" style="width:  70%;">' +
                '   </select>' +
                '</div>' +

                '<div class="form-group col-xs-12 col-sm-12 col-md-12">' +
                '   <label>Design</label>' +
                '   <br>' +
                '   <select id="find_textiles_design' + category_id + '" row_name="design"' +
                '       class="form-control" style="width:  70%;">' +
                '   </select>' +
                ' </div>' +

                '<div class="form-group col-xs-12 col-sm-12 col-md-12 ">' +
                '   <label>Color</label>' +
                '   <br>' +
                '   <select id="find_textiles_color' + category_id + '" row_name="color""' +
                '       class="form-control" style="width: 70%;">' +
                '   </select>' +
                '</div>' +

                '<div class="form-group col-xs-12 col-sm-12 col-md-12">' +
                '   <label>Structure</label>' +
                '   <br>' +
                '   <select id="find_textiles_structure' + category_id + '" row_name="structure" ' +
                '       class="form-control" style="width: 70%;">' +
                '   </select>' +
                '</div>' +

                '<div class="form-group col-xs-12 col-sm-12 col-md-12">' +
                '   <label>Weaving</label>' +
                '   <br>' +
                '   <select id="find_textiles_weaving' + category_id + '" row_name="weaving" ' +
                '       class="form-control" style="width: 70%;">' +
                '   </select>' +
                '</div>' +

                '<div class="form-group col-xs-12 col-sm-12 col-md-12">' +
                '   <label>Finishing</label>' +
                '   <br>' +
                '   <select id="find_textiles_finishing' + category_id + '" row_name="finishing"' +
                '       placeholder="-- Select the Finishing --"' +
                '       class="form-control" style="width: 70%;">' +
                '   </select>' +
                '</div>' +

                '<div class="form-group col-xs-12 col-sm-12 col-md-12">' +
                '   <label for="find_textiles_rating">Rating</label>' +
                '   <br>' +
                '   <select id="find_textiles_rating' + category_id + '" row_name="rating""' +
                '      class="form-control" style="width: 70%;">' +
                '   </select>' +
                '</div>' +
                '</div>'
            );

        }

        $(".show_form_if_is_checked_" + category_id).append(
            '<div class="form-group col-xs-12 col-sm-12 col-md-12 required">' +
            '   <label class="agile-label" for="customer">Furnizor</label>' +
            '   <br>' +
            '   <select class="form-control customer' + category_id + '"' +
            '   position_id="' + category_id + '"' +
            '   style="width: 70%;"> </select>' +
            '</div>' +

            '<div class="form-group col-xs-12 col-sm-12 col-md-12 required">' +
            '<label>Articol Name</label>' +
            '   <br>' +
            '   <select class="form-control product_name' + category_id + '"' +
            '   position_id="' + category_id + '"' +
            '   style="width: 70%;"> </select>' +
            '</div>' +

            '<div class="form-group col-xs-12 col-sm-12 col-md-12 ">' +
            '   <label>Cantitatea</label>' +
            '   <br>' +
            '   <input type="number" class="form-group" id="amount' + category_id + '" style="width: 70%;"/>' +
            '</div>'

        );

        searchCustomerSubcategories('subcategories');
        searchCustomers(category_id);
        searchWareNameOrCustomCode('product_name', category_id, 'product_name');

    }

    $('#template_child_form').on('click', '.add-button', function () {
        let category = $(this).parent().parent().children(1).val()
        // let position_id = $(this).parent().parent().children(1).attr('position_id')
        console.log(category);
        catehoriesBoxItems(category);
    })

    //asta e pentru remove
    $('#template_child_form').on('click', '.remove-button', function () {
        let category = $(this).parent().parent().children(1).attr('category_id')
        // let position_id = $(this).parent().parent().children(1).attr('position_id')

        // $(this).parent().remove();

    })

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
                    let subcategory = $('.subcategories').select2('data');
                    let subcategory_id = false;
                    if (subcategory && subcategory[0]) {
                        subcategory_id = subcategory[0].id;
                    }

                    let find_textiles_composition
                    let find_material
                    let find_textiles_design
                    let find_textiles_color
                    let find_textiles_structure
                    let find_textiles_weaving
                    let find_textiles_finishing
                    let find_textiles_rating
                    //if is in template create
                    if (window.location.pathname == '/admin/templates/create' && category_id === 8) {
                        let position_id = (this).attr("position_id");
                        find_textiles_composition = $('#find_textiles_composition' + position_id).select2('data')[0] || null
                        find_material = $('#find_material' + position_id).select2('data')[0] || null
                        find_textiles_design = $('#find_textiles_design' + position_id).select2('data')[0] || null
                        find_textiles_color = $('#find_textiles_color' + position_id).select2('data')[0] || null
                        find_textiles_structure = $('#find_textiles_structure' + position_id).select2('data')[0] || null
                        find_textiles_weaving = $('#find_textiles_weaving' + position_id).select2('data')[0] || null
                        find_textiles_finishing = $('#find_textiles_finishing' + position_id).select2('data')[0] || null
                        find_textiles_rating = $('#find_textiles_rating' + position_id).select2('data')[0] || null
                    }

                    return {
                        _token: CSRF_TOKEN,
                        search: params.term,
                        category_id: category_id,
                        subcategory_id: subcategory_id,
                        customer_id: getFieldValueByFieldClassSelect2(items_index, 'customer', 'id'),
                        product_name_selected: product_name_selected,
                        find_textiles_composition: check_if_object_key_exists(find_textiles_composition),
                        find_material: check_if_object_key_exists(find_material),
                        find_textiles_design: check_if_object_key_exists(find_textiles_design),
                        find_textiles_color: check_if_object_key_exists(find_textiles_color),
                        find_textiles_structure: check_if_object_key_exists(find_textiles_structure),
                        find_textiles_weaving: check_if_object_key_exists(find_textiles_weaving),
                        find_textiles_finishing: check_if_object_key_exists(find_textiles_finishing),
                        find_textiles_rating: check_if_object_key_exists(find_textiles_rating),

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
    function searchCustomerSubcategories(item_class) {

        $("." + item_class).select2({
            ajax: {
                url: "/admin/get_subcategoires_by_category_id",
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    let category_id = $(this).parent().parent().attr("category_id");

                    return {
                        _token: CSRF_TOKEN,
                        search: params.term,
                        category_id: category_id,
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
        let category_id = $(this).val();
        console.log(category_id);
        if ($(this).is(':checked')) {
            $('.show_form_if_is_checked_' + category_id).show();
            $('.add-remove-categorie' + category_id).show();
        } else {
            $('.show_form_if_is_checked_' + category_id).hide();
            $('.add-remove-categorie' + category_id).hide();

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
            $(".subcategories" + i).select2('val', 'All');
            $(".customer" + i).select2('val', 'All');
            $(".product_name" + i).select2('val', 'All');
            $(".custom_code" + i).select2('val', 'All');
            $(".bill_date" + i).select2('val', 'All');
            $(".bill_number" + i).select2('val', 'All');
            $('#amount' + i).val('');

            if (i >= 8) {
                $("#find_textiles_composition" + i).select2('val', 'All');
                $("#find_material" + i).select2('val', 'All');
                $("#find_textiles_design" + i).select2('val', 'All');
                $("#find_textiles_color" + i).select2('val', 'All');
                $("#find_textiles_structure" + i).select2('val', 'All');
                $("#find_textiles_weaving" + i).select2('val', 'All');
                $("#find_textiles_finishing" + i).select2('val', 'All');
                $("#find_textiles_rating" + i).select2('val', 'All');
            }
        }
    }

    function photos_fields_generate() {
        let child_photos = '';
        for (let i = 1; i <= $('.number_of_child').val(); ++i) {
            child_photos +=
                '<div style="display: none" id="child_photos' + i + '">' +
                '   <input type="file" accept="image/*" id="template_photo1' + i + '" name="template_photo1[]">' +
                '   <input type="file" accept="image/*" id="template_photo2' + i + '" name="template_photo2[]">' +
                '   <input type="file" accept="image/*" id="template_photo3' + i + '" name="template_photo3[]">' +
                '</div>'
        }
        $('#photos_area').html(child_photos);
    }

});

