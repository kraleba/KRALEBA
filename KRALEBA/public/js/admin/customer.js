var category = document.getElementById("categoryProduct");
var boxProvider = document.getElementById('checkProvider');


function checkBoxCustomer() {

    let boxCustomer = document.getElementById("checkCustomer");
    let customerForm = document.getElementById('customerOrProviderForm');

    if (boxCustomer.checked) {
        document.getElementById('checkProvider').checked = false;
        document.getElementById('subcategoryProduct').style.display = 'none';
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
    } else {
        category.style.display = "none";
    }

}

function showSubcategory(isSelected) {
    document.getElementById('subcategory').innerText = isSelected.options[isSelected.selectedIndex].text;

    if (isSelected.options[isSelected.selectedIndex].value > 0) {

        document.getElementById('subcategoryProduct').style.display = 'block';
        document.getElementById('customerOrProviderForm').style.display = 'block';

    } else {
        document.getElementById('subcategoryProduct').style.display = 'none';
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
                    $("#ddlNationality").append($('<span onclick="deleteSubcategory(' + value.subcategory_id + ')" class="fa fa-close" style="float:right; padding-top: 10px; padding-right: 10px"></span>')).append($('<li value=' + value.subcategory_id + '>' + value.name + '</li>'));

                    // <span className="glyphicon" style="float:right">&#xe020; </
                    // .val(value.subcategory_id).html(value.name)
                })
                // $("#ddlNationality").append(subcategories);
            }
        });
    }
);


$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "/admin/show_subcategory_by_category_id",
        dataType: "json",
        contentType: "application/json",
        success: function (res) {
            $.each(res.d, function (data, value) {

                $("#ddlNationality").append($("<option></option>").val(value.CountryId).html(value.CountryName));
            })
        }

    });

})


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
function deleteSubcategory(id) {

    $.ajax(
        {
            url: "subcategory/" + id,
            type: 'get',
            data: {
                "id": id,
            },
            success: function () {
                $('#subcategory' + id).remove();
                console.log("it Works");
            }
        }
    );
}

// search

const searchInputDropdown = document.getElementById('search-input-dropdown');
const dropdownOptions = document.querySelectorAll('.input-group-dropdown-item');

// searchInputDropdown.addEventListener('input', () => {
//     const filter = searchInputDropdown.value.toLowerCase();
//     showOptions();
//     const valueExist = !!filter.length;
//
//     if (valueExist) {
//         dropdownOptions.forEach((el) => {
//             const elText = el.textContent.trim().toLowerCase();
//             const isIncluded = elText.includes(filter);
//             if (!isIncluded) {
//                 el.style.display = 'none';
//             }
//         });
//     }
// });

const showOptions = () => {
    dropdownOptions.forEach((el) => {
        el.style.display = 'flex';
    })
}

//download pdf Jquery

$(".download-pdf").click(function () {
    console.log('sssssss')
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
