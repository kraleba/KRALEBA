<div id="customerOrProviderForm">
    <div class="row">

        <div class="col-xs-6 col-sm-6 col-md-6 categories_area" categories="{{json_encode($customer_categories)}}">

            <div class="form-group">
                <strong>Product Name</strong>
                <input type="text" name="product_name" id="template_name" class="form-control" placeholder="Product Name">
            </div>

            @foreach($customer_categories as $category)
                <div class="col-xs-12 col-sm-12 col-md-12 template-inputs">

                    <label>{{$category->name}}</label>
                    <input type="checkbox"
                           class="categories-box"
                           id="check_if_is_checked{{$category->category_id}}"
                           category_id="{{json_encode($category->category_id)}}"
                    >

                    <div id="show_category_by_id{{$category->category_id}}" style="display: none">
                        <form id="form_customer{{$category->category_id}}">

                            <div class="form-group">
                                <label>Furnizor</label>
                                <input name="customer" id="customer{{$category->category_id}}">
                            </div>

                            <div class="form-group">
                                <label>Product Name</label>
                                <input name="product_name" id='product_name{{$category->category_id}}'>
                            </div>

                            <div class="form-group">
                                <label>Custom Code</label>
                                <input name="bill_number" id="custom_code{{$category->category_id}}">
                            </div>


                            <div class="form-group">
                                <label>Data Facturarii</label>
                                <input name="bill_date" id="bil_date{{$category->category_id}}">
                            </div>


                            <div class="form-group">
                                <label>Numarul Facturii</label>
                                <input name="bill_number" id="bill_number{{$category->category_id}}">
                            </div>

                            <div class="form-group">
                                <label>Numarul Facturii</label>
                                <input type="number" name="amount" id="amount{{$category->category_id}}">
                            </div>
                        </form>
                    </div>

                </div>
            @endforeach

            <div class="form-group">
                <label>Upload Photo</label>
                <input type="file" id="template_photo1" name="template_photo1">
                <input type="file" id="template_photo2" name="template_photo2">
                <input type="file" id="template_photo3" name="template_photo3">
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <input type="button" class="btn btn-primary child-validate" value="valideaza">
            <button type="submit" class="btn btn-primary">Renunta</button>
        </div>
    </div>
</div>
