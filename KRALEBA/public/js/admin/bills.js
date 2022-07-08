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

$("#generateNumberOfArticle").on("click", function () {
    let indexNumberOfArticle = document.getElementById('indexNumberOfArticle').value;
    let numberOfArticles = document.getElementById('numberOfArticles').innerHTML;

    console.log('test');
    for (let i = 0; i < indexNumberOfArticle; ++i) {
        document.getElementById('numberOfArticles').innerHTML += numberOfArticles;
    }
});

/*Datae time modal*/
$(document).ready(function () {
    $("#startdate").datepicker();
    $("#enddate").datepicker();
});
/*Datae time modal end*/
