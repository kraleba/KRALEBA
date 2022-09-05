<div class="form-control">
    <h4> Creaza mai multe variante de prototipuri: </h4>
    <div class="categories_area" categories="{{json_encode($customer_categories)}}" style="display: none">

        <div class="d-flex justify-content-center">
            <b class="number-of-children-area">  </b>
        </div>


        <div id="template_child_form"></div>

        <div class="form-group" id="add_more_textile_btn">
            <small>
                <input type="button" class="add-more-textile" value="Adauga mai multe textile"/>
            </small>
        </div>

        <div class="form-group col-xs-12 col-sm-12 col-md-12">
            <input type="file" id="template_photo1" name="template_photo1">
            <input type="file" id="template_photo2" name="template_photo2">
            <input type="file" id="template_photo3" name="template_photo3">
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <input type="button" class="btn btn-primary child-validate" value="Valideaza">
        </div>
    </div>

</div>


