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
    } else {
        document.getElementById('subcategoryProduct').style.display = 'none';
    }

}

function showDataForm(isSelected) {

    if (isSelected.options[isSelected.selectedIndex].value) {
        document.getElementById('customerOrProviderForm').style.display = 'block';

    } else {
        document.getElementById('customerOrProviderForm').style.display = 'none';

    }
}


