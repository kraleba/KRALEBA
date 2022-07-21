//create ware select
function showWareTemplate() {
    let subcategory = document.getElementById('subcategorySelected').value;

    if (subcategory !== 'Textile') {
        document.getElementById('templateWare').style.display = 'block';
        document.getElementById('textileInputs').style.display = 'none';
    }
    if (subcategory === 'Textile') {
        document.getElementById('templateWare').style.display = 'block';
        document.getElementById('textileInputs').style.display = 'block';


    }
}

$('.show-alert-delete-box').click(function(event){
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: "Esti sigur ca vrei sa generezi factura?",
        text: "Asigura-te ca ai adaugat toate articolele!",
        icon: "warning",
        type: "warning",
        buttons: ["Cancel","Yes!"],
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});
$('.articole-alert-delete-box').click(function(event){
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: "Esti sigur ca vrei sa stergi?"
        icon: "warning",
        type: "warning",
        buttons: ["Cancel","Yes!"],
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});
