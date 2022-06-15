var text = document.getElementById("categoryProduct");
var boxProvider = document.getElementById('checkProvider');


function checkBoxCustomer() {

    let boxCustomer = document.getElementById("checkCustomer");
    let customerForm = document.getElementById('customerOrProviderForm');

    if (boxCustomer.checked) {
        document.getElementById('checkProvider').checked = false;
        document.getElementById('subcategoryProduct').style.display = 'none';
        document.getElementById('customerOrProviderForm').style.display = 'none';
        text.style.display = "none";


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
        text.style.display = "block";
    } else {
        text.style.display = "none";
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

$(".download-pdf").click(function(){
    console.log('sssssss')
    var data = '';
    $.ajax({
        type: 'GET',
        url: '/downloadPDF',
        data: data,
        xhrFields: {
            responseType: 'blob'
        },
        success: function(response){
            var blob = new Blob([response]);
            var link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = "Sample.pdf";
            link.click();
        },
        error: function(blob){
            console.log(blob);
        }
    });
});

