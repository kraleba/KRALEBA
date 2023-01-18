$(document).ready(function () {
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var templateCurrentTab = 0;

    if (window.location.pathname === '/admin/templates/create') {
        showTemplateTab(templateCurrentTab);
    }

    $('#template_prev_btn').click(function () {
        nextPrevTempalte(-1);
    });

    $('#template_next_btn').click(function () {
        nextPrevTempalte(1);
    });

    function nextPrevTempalte(nextOrPrev) {
        let number_children = $('.number_of_child').val();


        // if (nextOrPrev == 1 && !validateTemplateFields() || number_children < 1)
        //     return false;

        //generate children steps

        var tab = $(".template_tab");
        tab[templateCurrentTab].style.display = "none";

        templateCurrentTab = templateCurrentTab + nextOrPrev;
        if (number_children && templateCurrentTab <= number_children) {
            addChildrenAndSteps(nextOrPrev, number_children, templateCurrentTab);
        }

        if (templateCurrentTab >= $(".template_tab").length) {
            document.getElementById("parent_template").submit();
            return false;
        }

        // tab[templateCurrentTab].style.display = "block";

        showTemplateTab(templateCurrentTab);

    }

    function showTemplateTab(nextOrPrev) {

        var template_tab = $(".template_tab");
        template_tab[nextOrPrev].style.display = "block";
        if (nextOrPrev == 0) {
            document.getElementById("template_prev_btn").style.display = "none";
        } else {
            document.getElementById("template_prev_btn").style.display = "inline";
        }
        if (nextOrPrev == (template_tab.length - 1)) {
            document.getElementById("template_next_btn").innerHTML = "Submit";
        } else {
            document.getElementById("template_next_btn").innerHTML = "Next";
        }
        //... and run a function that will display the correct step indicator:
        fixStepIndicator(nextOrPrev)
    }

    function fixStepIndicator(nextOrPrev) {
        // This function removes the "active" class of all steps...
        var i, x = document.getElementsByClassName("step");

        for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
        }

        //... and adds the "active" class to the current step:
        x[nextOrPrev].className += " active";
    }

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

    // show form when tipe of template is selected
    $('#template_gender_type, #template_gender_type1').click(function () {
        if ($(this).is(':checked')) {
            $(".template_prev_next_btns").show();
            $("#template_parent_box").show();
        }
    });

    function addChildrenAndSteps(nextOrPrev, number_steps, templateCurrentTab) {

        if (!number_steps || number_steps < 1) {
            return false;
        }

        let steps = $('#template-steps-area').children().length;

        if (steps === 1) {
            for (let i = 0; i < parseInt(number_steps); ++i) {
                document.getElementById('template-steps-area').innerHTML += '<span class="step"></span>'

            }
        }

        var template_tab = $(".template_tab");
        if (template_tab.length <= number_steps && nextOrPrev == 1 && !template_tab[templateCurrentTab]) {
            templateChildrenFields(templateCurrentTab)
        }
    }

    function templateChildrenFields(templateCurrentTab) {
        $(".children-fields").append(`
            <div class="template_tab">
            </div>
        `);

        let categories = take_categories();
        let template_tab = $('.template_tab');

        $.each(categories, function (key, value) {
            checkBoxCategories(value, template_tab, templateCurrentTab);
            // addRemoveCategory(value, template_tab, templateCurrentTab)
        });
    }

    function checkBoxCategories(category, template_tab, templateCurrentTab) {
        // alert('asdf');

        $(template_tab[templateCurrentTab]).append(`
            <div class="category-box" data-cloneable> 
                <div class="col-xs-12 col-sm-12 col-md-12 checkbox-box">
                    <input 
                        type="checkbox"
                        value="${category['id']}"
                        class="checkbox_customer_category"
                    >  ${category["name"]}
                </div>
                <div class="flex-container">
                    <button 
                        type="button"
                        class="btn btn-light btn-sm add-category"
                        data-category= ${category}
                        data-templateCurrentTab= ${templateCurrentTab}
                    >
                        <i class="fa fa-plus"></i> Adauga
                    </button>

                    <button type="button" class="btn btn-secondary btn-sm remove-category">
                        <i class="fa fa-times"></i> Sterg
                    </button>
                </div>
            </div>

        `);
    }

    $('.children-fields').on('click', '.add-category', function () {
        

        var newItem = $(this).closest(".category-box[data-cloneable]").clone();
        $(this).closest(".category-box[data-cloneable]").after(newItem);

        // var newItem = $(this).prev(".category-box[data-cloneable]").clone();
        // $(this).prev(".category-box[data-cloneable]").after(newItem);

    });
    $("#item-list").on("click", ".add-button", function () {
        var newItem = $(this).prev(".item[data-cloneable]").clone();
        $(this).prev(".item[data-cloneable]").after(newItem);
    });
});
