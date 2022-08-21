<div class="container child-box-create-edit">

    <h4> Creaza un prototip copil </h4>
    <div class="categories_area" categories="{{json_encode($customer_categories)}}">

        @foreach($customer_categories as $category)
            <div class="template-inputs">
                <div class="col-md-12">
                    <div class="form-check ">
                        <input type="checkbox"
                               class="form-check-input categories-box"
                               id="check_if_is_checked{{$category->id}}"
                               category_id="{{json_encode($category->id)}}"
                        >
                        <label class="form-check-label">{{$category->name}}</label>
                    </div>

                    <div id="show_category_by_id{{$category->id}}" style="display: none">
                        <div id="form_customer{{$category->id}}">
                            <div class="form-group">
                                <label>Furnizor</label>
                                <input name="customer" class="form-control" id="customer{{$category->id}}">
                            </div>

                            <div class="form-group">
                                <label>Custom Code</label>
                                <input name="bill_number" class="form-control" id="custom_code{{$category->id}}">
                            </div>


                            <div class="form-group">
                                <label>Data Facturarii</label>
                                <input name="bill_date" class="form-control" id="bil_date{{$category->id}}">
                            </div>


                            <div class="form-group">
                                <label>Numarul Facturii</label>
                                <input name="bill_number" class="form-control" id="bill_number{{$category->id}}">
                            </div>

                            <div class="form-group">
                                <label>Cantitatea</label>
                                <input type="number" class="form-control" name="amount" id="amount{{$category->id}}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

        <div class="form-group">
            <label>Upload Photo</label>
            <div>
                <input type="file" id="template_photo1" name="template_photo1">
                <input type="file" id="template_photo2" name="template_photo2">
                <input type="file" id="template_photo3" name="template_photo3">
            </div>
        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 ">
        <input type="button" class="btn btn-primary child-validate" value="Valideaza">
    </div>
    <br>
</div>
<br>


