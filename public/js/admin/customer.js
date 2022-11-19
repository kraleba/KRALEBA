
var category = document.getElementById("categoryProduct");
var boxProvider = document.getElementById('checkProvider');


function checkBoxCustomer() {

    let boxCustomer = document.getElementById("checkCustomer");
    let customerForm = document.getElementById('customerOrProviderForm');

    if (boxCustomer.checked) {
        document.getElementById('checkProvider').checked = false;
        document.getElementById('customerOrProviderForm').style.display = 'none';
        category.style.display = "none";


        customerForm.style.display = "block";

    } else {
        customerForm.style.display = "none";
    }

}

function checkBoxProvider() {

    let boxCustomer = document.getElementById("checkCustomer");

    document.getElementById('customerOrProviderForm').style.display = "none";
    document.getElementById("checkCustomer").checked = false;

    if (boxProvider.checked) {
        category.style.display = "block";
        document.getElementById('customerOrProviderForm').style.display = 'block';

    } else {
        category.style.display = "none";
        document.getElementById('customerOrProviderForm').style.display = 'none';

    }

}

$(".show-subcategory").click(function () {

    var category_id = $("#category_id").val();

    $.ajax({
        url: "/admin/show_subcategory_by_category_id",
        type: 'GET',
        dataType: "json",
        data: {
            category_id: category_id,
        },
        success: function (res) {
            $('#ddlNationality li').remove();
            $('#ddlNationality span').remove();
            $.each(res, function (data, value) {
                $("#ddlNationality").append($('<span onclick="deleteSubcategory(' + value.id + ')" class="fa fa-close" style="float:right; padding-top: 10px; padding-right: 10px"></span>')).append($('<li value=' + value.id + '>' + value.name + '</li>'));

            })
            // $("#ddlNationality").append(subcategories);
        }
    });
}
);

//filter index.blade.php
function filterFunction() {

    document.getElementById("myDropdown").classList.toggle("show");

    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}

//Dropdown put in input selected value

function dropDownValue(id) {
    document.getElementById("dropdownInput").value = document.getElementById(id).innerText;

}

//delete subcategory
function deleteSubcategory(id, page_index) {

    if (!page_index) {
        page_index = '';
    }

    $.ajax(
        {
            url: window.location.origin + "/admin/delete_subcategory/",
            type: 'get',
            data: {
                "id": id,
            },
            success: function () {
                $("#subcategory_id_input" + id + page_index).remove();
                $("#subcategory_id_delete" + id + page_index).remove();
                $("#subcategory_id_label" + id + page_index).remove();
                $("#subcategory_id_br" + id + page_index).remove();
            }
        }
    );
}

//when is added a new subcategory
function addSubcategoryForCustomersId(category_id, subcategory_input_type = null, page_index) {
    if (!page_index) {
        page_index = '';
    }

    let subcategoryLabel = document.getElementById('subcategoryLabel' + category_id + page_index).value;
    if (!subcategoryLabel) {
        return false;
    }

    let input_type = 'checkbox';
    //if come from create bills make input type radio
    let array_or_unique = '[]';
    if (subcategory_input_type) {
        input_type = 'radio';
        array_or_unique = page_index;
    }

    $.ajax(
        {
            url: window.location.origin + "/admin/helper_add_subcategory",
            type: 'get',
            data: {
                "category_id": category_id,
                "subcategory_label": subcategoryLabel
            },
            success: function (res) {

                if (res.id) {
                    $("#subcategory_list" + category_id + page_index)
                        .append($("<input name='subcategories_id" + array_or_unique + "' id='subcategory_id_input" + res.id + page_index + "' type= " + input_type + " value='" + res.id + "'>" +
                            "<label id='subcategory_id_label" + res.id + page_index + "'>" + res.name + " </label>" +
                            "<span style='color: red; cursor: pointer' id='subcategory_id_delete" + res.id + page_index + "' onclick='deleteSubcategory(" + res.id + ',' + page_index + ")'> X </span>" +
                            "<br id='subcategory_id_br" + res.id + page_index + "'>"))

                    document.getElementById('subcategoryLabel' + category_id + page_index).value = '';
                }
            }
        }
    );
}

//show existences subcategories
let customer_id;
window.onload = (event) => {
    //from edit customer
    var categories = $('#category').attr("categories");
    customer_id = $('#category').attr("customer_id");

    if (categories || customer_id) {
        showSubcategoryWhenIsEdited(JSON.parse(categories));
    }
}

function showSubcategoryWhenIsEdited(categories) {
    let index = [];
    let subcategories = [];
    $.each(categories, function (data, value) {
        index[value.category_id] = value.category_id;
        subcategories[value.subcategory_id] = value.subcategory_id;
    });

    const category_id = index.filter(function (el) {
        return el != null;
    });
    // const subcategories_filtrated = subcategories.filter(function (el) {
    //     return el != null;
    // });

    // console.log(category_id);

    $.each(category_id, function (data, value) {
        showSubcategoryByCategoryId(value, subcategories)
        // console.log(value);
    });
}

function showSubcategoryByCategoryId(category_id, existing_subcategory = null, categories_id = null, page_index) {
    if (!page_index) {
        page_index = '';
    }

    let category = document.getElementById('category_id' + category_id + page_index);

    if (category.type === 'radio' && categories_id) {
        hideAllSubcategoriesIfIsSHow(categories_id, page_index);
    }

    if (category.checked) {

        // show subcategories if category id is not 8 (Textile)
        if (category_id !== 8) {
            // category.style.display = 'block';
            document.getElementById('subcategory_box' + category_id + page_index).style.display = 'block';
        }

        let subcategories_field_type = 'checkbox'

        let array_or_unique = '[]';
        if (category.type === 'radio') {
            subcategories_field_type = 'radio'
            array_or_unique = page_index;
        }

        $.ajax({
            type: "GET",
            url: "/admin/show_subcategory_by_category_id",
            dataType: "json",
            data: {
                "category_id": category_id,
            },
            contentType: "application/json",
            success: function (res) {
                $.each(res, function (data, value) {
                    console.log(page_index);

                    $("#subcategory_list" + category_id + page_index)
                        .append($("<input name='subcategories_id" + array_or_unique + "' id='subcategory_id_input" + value.id + page_index + "' type=" + subcategories_field_type + " value='" + value.id + "'>" +
                            " <label id='subcategory_id_label" + value.id + page_index + "'> " + value.name + " </label>" +
                            "<span style='color: red; cursor: pointer' id='subcategory_id_delete" + value.id + page_index + "' onclick='deleteSubcategory(" + value.id + ',' + page_index + ")'> X </span>" +
                            "<br id='subcategory_id_br" + value.id + page_index + "'>"))

                    let subcategory = document.getElementById('subcategory_id_input' + value.id + page_index).value;

                    try {
                        if (existing_subcategory && subcategory.toString() == existing_subcategory[subcategory.toString()]) {
                            document.getElementById('subcategory_id_input' + value.id + page_index).checked = true;
                        }
                    } catch (e) {
                    }
                })
            }

        });
    } else {

        if (category_id !== 8 && category.type !== 'radio') {
            document.getElementById('subcategory_box' + category_id + page_index).style.display = 'none';
        }

        $("#subcategory_list" + category_id + page_index + ' input').remove();
        $("#subcategory_list" + category_id + page_index + ' label').remove();
        $("#subcategory_list" + category_id + page_index + ' span').remove();
        $("#subcategory_list" + category_id + page_index + ' br').remove();

    }

}

//download pdf Jquery

$(".download-pdf").click(function () {
    // console.log('sssssss')
    var data = '';
    $.ajax({
        type: 'GET',
        url: '/downloadPDF',
        data: data,
        xhrFields: {
            responseType: 'blob'
        },
        success: function (response) {
            var blob = new Blob([response]);
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = "Sample.pdf";
            link.click();
        },
        error: function (blob) {
            console.log(blob);
        }
    });
});


function filterFunction(that, event) {
    let container, input, filter, li, input_val;
    container = $(that).closest(".searchable");
    input_val = container.find("input").val().toUpperCase();

    if (["ArrowDown", "ArrowUp", "Enter"].indexOf(event.key) != -1) {
        keyControl(event, container)
    } else {
        li = container.find("ul li");
        li.each(function (i, obj) {
            if ($(this).text().toUpperCase().indexOf(input_val) > -1) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        container.find("ul li").removeClass("selected");
        setTimeout(function () {
            container.find("ul li:visible").first().addClass("selected");
        }, 100)
    }
}

function keyControl(e, container) {
    if (e.key == "ArrowDown") {

        if (container.find("ul li").hasClass("selected")) {
            if (container.find("ul li:visible").index(container.find("ul li.selected")) + 1 < container.find("ul li:visible").length) {
                container.find("ul li.selected").removeClass("selected").nextAll().not('[style*="display: none"]').first().addClass("selected");
            }

        } else {
            container.find("ul li:first-child").addClass("selected");
        }

    } else if (e.key == "ArrowUp") {

        if (container.find("ul li:visible").index(container.find("ul li.selected")) > 0) {
            container.find("ul li.selected").removeClass("selected").prevAll().not('[style*="display: none"]').first().addClass("selected");
        }
    } else if (e.key == "Enter") {
        container.find("input").val(container.find("ul li.selected").text()).blur();
        // onSelect(container.find("ul li.selected").text())
    }

    container.find("ul li.selected")[0].scrollIntoView({
        behavior: "smooth",
    });
}

// function onSelect(val) {
//     alert(val)
// }

$(".searchable input").focus(function () {
    $(this).closest(".searchable").find("ul").show();
    $(this).closest(".searchable").find("ul li").show();
});
$(".searchable input").blur(function () {
    let that = this;
    setTimeout(function () {
        $(that).closest(".searchable").find("ul").hide();
    }, 300);
});

$(document).on('click', '.searchable ul li', function () {
    $(this).closest(".searchable").find("input").val($(this).text()).blur();
    // onSelect($(this).text())
});

$(".searchable ul li").hover(function () {
    $(this).closest(".searchable").find("ul li.selected").removeClass("selected");
    $(this).addClass("selected");
});


/* ------- Bills alert delete --------*/
$('.bills-alert-delete').click(function (event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: "Esti sigur ca vrei sa stergi factura?",
        text: "Daca stergi factura se vor sterge si articolele din aceasta!",

        icon: "warning",
        type: "warning",
        buttons: ["Cancel", "Yes!"],
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});
/* ------- END Bills alert delete --------*/

/*---- Customers search ----*/
$(document).ready(function () {
    $("#find_customer").autocomplete({
        source: function (request, response) {
            searchCustomersSuggestions(request, response);
        },
        minLength: 0
    });
});
/*---- Customers search ----*/

function hideAllSubcategoriesIfIsSHow(categories_id, page_index) {
    console.log(categories_id);
    for (let i = 0; i <= categories_id.length; ++i) {
        if (categories_id[i]) {

            $("#subcategory_list" + categories_id[i] + page_index + ' input').remove();
            $("#subcategory_list" + categories_id[i] + page_index + ' input').remove();
            $("#subcategory_list" + categories_id[i] + page_index + ' label').remove();
            $("#subcategory_list" + categories_id[i] + page_index + ' span').remove();
            $("#subcategory_list" + categories_id[i] + page_index + ' br').remove();
            document.getElementById('subcategory_box' + categories_id[i] + page_index).style.display = 'none';
        }

    }

}
