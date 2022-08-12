// $('#validate_product').click(function() {
//     $('#bills_ware_modal').hide();
// });
let data = [];
$("#validate_product").on("click", function (e) {
    e.preventDefault(); // prevent de default action, which is to submit
    // save your value where you want
    // data.select = $("#bills_ware_modal").value();
    // or call the save function here
    // save();


    $(this).prev().click();

});

let index = false;

$("#generateNumberOfArticle").on("click", function () {

    if (index) {
        document.getElementById('numberOfArticles').innerHTML = '';
    }

    let indexNumberOfArticle = document.getElementById('indexNumberOfArticle').value;

    let numberOfArticles = document.getElementById('templateWareModal').innerHTML;
    for (let i = 0; i < indexNumberOfArticle; ++i) {
        document.getElementById('numberOfArticles').innerHTML +=
            '<div id="boxTemplate' + i + '">' +
            '<div id="test12' + i + '">'
            + numberOfArticles + '<input type="button" value="Valideaza" onclick="articleValidation(' + i + ')">' +
            '</div>' +
            '</div>';
        if (i > 0) {
            // document.getElementById("test12" + i).style.display = 'none';
        }
    }
    index = true;
});

function articleValidation(item) {
    // document.getElementById("test12" + item).style.display = 'none';
    document.getElementById("test12" + item + 1).style.display = 'block';
}



