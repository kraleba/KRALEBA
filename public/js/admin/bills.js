$(document).ready(function () {

    searchCustomers('-search');
    /*get categories from customer selected*/
    $('.customer-search').on("select2:selecting", function (e) {
        $.ajax({
            url: "/admin/get_customer_coin",
            type: "get",
            dataType: 'json',
            delay: 250,
            data: {
                customer_id: e.params.args.data.id,
            },
            success: function (res) {
                $(".customer-coin").val(res.label)
                document.getElementById('customer-coin-label').setAttribute('value', res.label)
                document.getElementById('customer-coin-id').setAttribute('value', res.id)
            }
        });

    });

    /*set customer if for */
    $("#customer_select").change(function () {
        $("#show_customer_id_selected").val($('.customer-search').val());
    });

    /*bills start date and end date validator if one is completed and other no*/
    $("#searchBtn").click(function () {

        let start_date = $('#bills_start_date')
        let end_date = $('#bills_end_date')

        if (start_date.val()) {
            end_date.prop('required', true);
        }

        if (end_date.val()) {
            start_date.prop('required', true);
        }

        if (!start_date.val() && !end_date.val()) {
            start_date.prop('required', false);
            end_date.prop('required', false);
        }
    });

    /*set customer if for */
    $("#customer_select").change(function () {
        $("#show_customer_id_selected").val($('.customer-search').val());
    });

    /*bills start date and end date validator if one is completed and other no*/
    $("#searchBtn").click(function () {

        let start_date = $('#bills_start_date')
        let end_date = $('#bills_end_date')

        if (start_date.val()) {
            end_date.prop('required', true);
        }

        if (end_date.val()) {
            start_date.prop('required', true);
        }

        if (!start_date.val() && !end_date.val()) {
            start_date.prop('required', false);
            end_date.prop('required', false);
        }
    });

});

/* show  bills form */
function showBillsCreateForm() {
    if(document.querySelector('input[name="type"]:checked')) {
        document.getElementById('form_create_bill').style.display = "block";
        document.getElementById('form_create_bil_steps').style.display = "block";
    }
}

var currentTab = 0; // Current tab is set to be the first tab (0)
const url = window.location.pathname;
if(url == '/admin/bills/create')
showTab(currentTab); // Display the current tab

function showTab(index_tab) {

    var x = document.getElementsByClassName("tab");
    x[index_tab].style.display = "block";

    if (index_tab === 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    let number_of_article = document.getElementById("indexNumberOfArticle").value;

    if (index_tab === (x.length - 1) && index_tab === parseInt(number_of_article)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }

    fixStepIndicator(index_tab)

}

function addStepsOfArticle() {

    let number_of_article = document.getElementById("indexNumberOfArticle").value;

    if (!number_of_article || number_of_article < 1) {
        return false;
    }

    let steps = $('#steps-area').children().length;

    if (steps === 1) {

        for (let i = 0; i < parseInt(number_of_article); ++i) {
            document.getElementById('steps-area').innerHTML += '<span class="step"></span>'
        }
    }

}
// trebuie sa testez sa vad acum daca merge corect
function nextPrev(previous_or_next) {

    var x = document.getElementsByClassName("tab");
    if (previous_or_next === 1 && !validateForm(previous_or_next, currentTab))
        return false;

    let number_of_steps = document.getElementById("indexNumberOfArticle").value;
    number_of_steps++;

    x[currentTab].style.display = "none";
    currentTab = currentTab + previous_or_next;

    if (x.length < number_of_steps) {
        addStepsOfArticle();
        if (previous_or_next === 1) {
            articleFormGenerate(previous_or_next, currentTab);

        }
    }

    if (currentTab >= x.length) {
        // ... the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }

    // Otherwise, display the correct tab:
    showTab(currentTab);
}

function validateForm(previous_or_next, page_index) {
    // This function deals with validation of the form fields
    let x, y, valid = true, index = 0, parent = '';

    for (let i = 0; i < 3; ++i) {

        if (document.querySelector('.parent_items' + i) && $('.parent_items' + i).is(":visible")) {
            x = document.getElementsByClassName("parent_items" + i);
            y = x[currentTab].getElementsByTagName("input");
            let parents = x[currentTab].children;
            if (!validatorFormHelper(y, parents)) {
                ++index;
            }

            y = x[currentTab].getElementsByTagName("select")
            if (!validatorFormHelper(y, parents)) {
                ++index;
            }

        }

    }

    if (validateSubcategoryForm(previous_or_next, page_index) && index === 0) {
        document.getElementsByClassName("step")[currentTab].className += ' finish';
    } else {
        valid = false;
    }
    return valid; // return the valid status
}

function validateSubcategoryForm(previous_or_next, page_index) {

    if ((previous_or_next !== -1)) {
        if (page_index > 0) {
            console.log($('input[name=categories_id' + page_index + ']:checked').length)
            console.log(page_index)

            if (!$('input[name=categories_id' + page_index + ']:checked').length) {
                alert('Nu ai selectat nici o categorie');
                return false;
            }
            let category_id = $('input[name=categories_id' + page_index + ']:checked').val();
            if (!$('input[name=subcategories_id' + page_index + ']:checked').length && category_id != 8) {
                alert('Nu ai selectat nici o subcategorie');
                return false;
            }
        }
    }

    return true;

}

function validatorFormHelper(y, parents) {

    let valid = true

    for (let i = 0; i < y.length; i++) {
        // console.log(y[i].className);
        if (parents[i].className) {
            if (y[i].value === "" && parents[i].className.split(" ").includes('required')) {
                y[i].className += " invalid";
                valid = false;
            }
        }
    }

    return valid;
}

function fixStepIndicator(index_tab) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[index_tab].className += " active";
}

function articleFormGenerate(previous_or_next, x) {

    let customer_id = getFieldValueByFieldClassSelect2('customer-search', '', 'id');
    let categories = take_categories(customer_id);


    let option_for_select = '';
    let select_category = '';

    if (previous_or_next !== -1) {

        let categories_id = [];
        $.each(categories, function (index, value) {
            categories_id[index] = value.id;
        });
        $.each(categories, function (index, value) {

            option_for_select +=
                '<div class="form-group col-xs-12 col-sm-12 col-md-12">' +
                '<input type="radio"' +
                '   id="category_id' + value.id + x + '"' +
                '   onchange="showSubcategoryByCategoryId(' + value.id + ',' + null + ',' + JSON.stringify(categories_id) + ',' + x + ')"' +
                '   class="form-item "' +
                '   name="categories_id' + x + '"' +
                '   value="' + value.id + '"' +
                '>' +
                '<label>' + value.name + '</label>' +
                '<br>' +
                '<div class="card subcategory-card" id="subcategory' + value.id + x + '">' +
                '<div id="subcategory_list' + value.id + x + '"></div>' +
                '<div id="subcategory_box' + value.id + x + '" style="display: none">' +
                '     <input placeholder="add subcategory" type="text" id="subcategoryLabel' + value.id + x + '">' +
                '     <input onclick="addSubcategoryForCustomersId(' + value.id + ', ' + "'radio'" + ',' + x + ')"' +
                '            type="button" value="Add">' +
                '  </div>' +
                '  </div>' +
                ' </div>'
        });

    }
    
    $("#article_form").append(
        '<div class="tab">' +
        '<filedset>' +
        '        <input type="hidden" name="category_id[]" id="categories_id' + x + '"> ' +
        '<div id="categories_select' + x + '">' +
        '' + option_for_select + '' +
        '</div>' +
        '       <div class="parent_items0">\n' +
        '                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                            <strong>Product Name:</strong>\n' +
        '                            <input type="text" name="product_name[]" class="form-control"\n' +
        '                                   placeholder="Product Name" oninput="this.className = \'form-control\' ">\n' +
        '                            \n' +
        '                    </div>\n' +
        '\n' +
        '                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                            <strong>Custom code:</strong>\n' +
        '                            <input type="text" name="custom_code[]" class="form-control"\n' +
        '                                   placeholder="Custom code" oninput="this.className = \'form-control\' ">\n' +
        '                    </div>\n' +
        '\n' +
        '                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                            <strong>Description:</strong>\n' +
        '                            <input type="text" name="description[]" class="form-control"\n' +
        '                                   placeholder="Description" oninput="this.className = \'form-control\' ">\n' +
        '                           \n' +
        '                    </div>' +

        '                   <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                            <strong>Moneda:</strong>' +
        '                            <input type="text"' +
        '                                   readonly="readonly"' +
        '                                   class="form-control"' +
        '                                   id="coin_label_by_customer' + x + '"' +
        '                                   placeholder="Moneda">\n' +
        '                   </div>' +
        '                   <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                          <input' +
        '                               type="hidden"' +
        '                               class="form-control"' +
        '                               id="customer_coin_id' + x + '" ' +
        '                               name = "coin[]"' +
        '                               > ' +

        '                   </div>' +
        '       </div>' +

        '  ' + secondaryFields(x) + '' +

        '       <div class="parent_items2">\n' +
        '                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                            <strong>UM:</strong>\n' +
        '                            <select name="um[]" class="form-select" oninput="this.className = \'form-control\' ">\n' +
        '                                <option disabled selected value> Selecteaza UM </option>\n' +
        '                                <option>Bucati</option>\n' +
        '                                <option>Ml</option>\n' +
        '                                <option>Gr</option>\n' +
        '                                <option>Kg</option>\n' +
        '                            </select>\n' +
        '                    </div>\n' +
        '\n' +
        '                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                            <strong>Cantitatea:</strong>\n' +
        '                            <input type="number" name="amount[]" class="form-control" placeholder="Cantitatea" oninput="this.className = \'form-control\' ">\n' +
        '                            \n' +
        '                    </div>\n' +

        '                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                            <strong>Pret:</strong>\n' +
        '                            <input type="number" name="price[]" class="form-control" placeholder="Pret" oninput="this.className = \'form-control\' ">\n' +
        '                           \n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '\n' +
        '    </div>' +
        '</filedset>' +
        '</div>'
    )

    document.getElementById('customer_coin_id' + x).setAttribute("value", $("#customer-coin-id").val())
    document.getElementById('coin_label_by_customer' + x).setAttribute("value", $("#customer-coin-label").val())
}

function showHideExtraFields(value, category_id) {

    document.getElementById('categories_id' + value).value = category_id;

    if (category_id === 8) {
        document.getElementById('secondary-attr' + value).style.display = "block";
    } else {
        document.getElementById('secondary-attr' + value).style.display = "none";
    }

}

function secondaryFields(x) {
    return '<div class="secondary-attr parent_items1" id="secondary-attr' + x + '" style="display: none">' +
        '                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                                <strong>Composition:</strong>\n' +
        '                                <input type="text" name="composition[]" class="form-control"\n' +
        '                                       placeholder="Composition" oninput="this.className = \'form-control\' ">\n' +
        '                               \n' +
        '                      </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                                <strong>Material:</strong>\n' +
        '                                <input type="text" name="material[]" class="form-control"\n' +
        '                                       placeholder="Material" oninput="this.className = \'form-control\' ">\n' +
        '                              \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                                <strong>Structure:</strong>\n' +
        '                                <input type="text" name="structure[]" class="form-control"\n' +
        '                                       placeholder="Structure" oninput="this.className = \'form-control\' ">\n' +
        '                               \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                                <strong>Design:</strong>\n' +
        '                                <input type="text" name="design[]" class="form-control"\n' +
        '                                       placeholder="Design" oninput="this.className = \'form-control\' ">\n' +
        '                               \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                                <strong>Weaving:</strong>\n' +
        '                                <input type="text" name="weaving[]" class="form-control"\n' +
        '                                       placeholder="Weaving" oninput="this.className = \'form-control\' ">\n' +
        '                               \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                                <strong>Color:</strong>\n' +
        '                                <input type="text" name="color[]" class="form-control"\n' +
        '                                       placeholder="Color" oninput="this.className = \'form-control\' ">\n' +
        '                               \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group required">\n' +
        '                                <strong>Finishing:</strong>\n' +
        '                                <input type="text" name="finishing[]" class="form-control"\n' +
        '                                       placeholder="Finishing" oninput="this.className = \'form-control\' ">\n' +
        '                               \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong>Perceived\n' +
        '                                    weight:</strong>\n' +
        '                                <input type="text" name="perceived_weight[]" class="form-control"\n' +
        '                                       placeholder="Perceived weight" oninput="this.className = \'form-control\' ">\n' +
        '                             \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong>Softness:</strong>\n' +
        '                                <input type="text" name="softness[]" class="form-control" placeholder="Softness" oninput="this.className = \'form-control\' ">\n' +
        '                              \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong>Look:</strong>\n' +
        '                                <input type="text" name="look[]" class="form-control" placeholder="Look" oninput="this.className = \'form-control\' ">\n' +
        '                               \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong>Grounds:</strong>\n' +
        '                                <input type="text" name="grounds[]" class="form-control" placeholder="Grounds" oninput="this.className = \'form-control\' ">\n' +
        '                               \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong>Weight in\n' +
        '                                    g/m2:</strong>\n' +
        '                                <input type="text" name="weight_in_g_m2[]" class="form-control"\n' +
        '                                       placeholder="Weight in g/m2" oninput="this.className = \'form-control\' ">\n' +
        '                              \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong>Width\n' +
        '                                    (cm):</strong>\n' +
        '                                <input type="text" name="width[]" class="form-control" placeholder="Width (cm)" oninput="this.className = \'form-control\' ">\n' +
        '                               \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong>Yarn number\n' +
        '                                    warp:</strong>\n' +
        '                                <input type="text" name="warp_th_per_cm[]" class="form-control"\n' +
        '                                       placeholder="Yarn number warp" oninput="this.className = \'form-control\' ">\n' +
        '                                \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong>Yarn count per cm\n' +
        '                                    warp:</strong>\n' +
        '                                <input type="text" name="warp_th_per_yarn_ne[]" class="form-control"\n' +
        '                                       placeholder="Yarn count per cm warp" oninput="this.className = \'form-control\' ">\n' +
        '                             \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong>Yarn count per cm\n' +
        '                                    weft:</strong>\n' +
        '                                <input type="text" name="weft_p_per_cm[]" class="form-control"\n' +
        '                                       placeholder="Yarn count per cm weft" oninput="this.className = \'form-control\' ">\n' +
        '                                \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong>Origin:</strong>\n' +
        '                                <input type="text" name="origin[]" class="form-control" placeholder="Origin" oninput="this.className = \'form-control\' ">\n' +
        '                                \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong><i class="fa fa-asterisk"\n' +
        '                                           style="font-size:7px;color:red; vertical-align: top;"></i>Date:</strong>\n' +
        '                                <input type="text" name="date[]" class="form-control" placeholder="Date" oninput="this.className = \'form-control\' ">\n' +
        '                               \n' +
        '                        </div>\n' +
        '\n' +
        '                        <div class="col-xs-12 col-sm-12 col-md-12 form-group">\n' +
        '                                <strong><i class="fa fa-asterisk"\n' +
        '                                           style="font-size:7px;color:red; vertical-align: top;"></i>Rating:</strong>\n' +
        '                                <input type="text" name="rating[]" class="form-control" placeholder="Rating:" oninput="this.className = \'form-control\' ">\n' +
        '                                \n' +
        '                        </div>\n' +
        '</div>'
}

