//create ware select
function showWareTemplate() {
    let subcategory = document.getElementById('subcategorySelected').value;

    if (subcategory !== '8') {
        document.getElementById('templateWare').style.display = 'block';
        document.getElementById('textileInputs').style.display = 'none';
    }
    if (subcategory === '8') {
        document.getElementById('templateWare').style.display = 'block';
        document.getElementById('textileInputs').style.display = 'block';


    }
}
