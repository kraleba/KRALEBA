<div class="form-control">
    <h4> Creaza mai multe variante de prototipuri: </h4>
    <div class="categories_area" categories="{{ json_encode($customer_categories) }}" style="display: none">
        <!-- Dropdown -->

        <br />
        <div id='result'></div>
        <div class="d-flex justify-content-center">
            <b class="number-of-children-area"> </b>
        </div>

        <div id='categories_form'>
            <div id="template_child_form"></div>

            {{-- <div class="form-group">
                <div id="add_more_items_box">
                    <input type="number" id="child_number_of_extra_items">
                    <small>
                        <input type="button" id="add_mote_items" value="Adauga mai multe Textile" />
                    </small>
                </div>
            </div> --}}

            <div class="form-group col-xs-12 col-sm-12 col-md-12" id="photos_area">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="button" class="btn btn-primary child-validate" value="Valideaza">
            </div>
        </div>
    </div>

</div>
