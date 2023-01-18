@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Prototipe</h2>
        </div>

    </div>
</div>

@if ($errors->any())

<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>

@endif

<form action="{{ route('templates.store') }}" method="POST" id="parent_template" enctype="multipart/form-data">
    @csrf

    <div class="col-xs-12 col-sm-12 col-md-12">
        <input type="radio" name="type" value="Abelard" id="template_gender_type">
        <label for="Abelard">Abelard</label>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <input type="radio" class="" name="type" value="Heloise" id="template_gender_type1">
        <label for="Heloise">Heloise</label>
    </div>

    <div class="children-fields">
        <div class="template_tab">
            <div id="customerOrProviderForm">
                <div class="row" id="template_parent_box">

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Number of Products</strong>
                            <input type="number" value='10' name="number_of_child" class="form-control required number_of_child" id="number_of_child" placeholder="Number of Products">
                        </div>
                    </div>

                    <div class="form-group col-xs-6 col-sm-6 col-md-6 required">
                        <strong>Product Name</strong>
                        <input type="text" name="product_name" id="template_name" class="form-control required" placeholder="Product Name">
                    </div>

                    <div class="form-group col-xs-6 col-sm-6 col-md-6 required">
                        <strong for="marketing_category_id">Tayloring:</strong>
                        <select class="form-control required" name="marketing_category_id" id="marketing_category_id" required>
                            @foreach($tailoring_categories as $tailoring_category)
                            <option value="{{$tailoring_category->id}}">{{$tailoring_category->name}}</option>
                            @endforeach
                            <option selected="selected" value="">No category</option>
                        </select>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Category:</strong>
                            <input type="text" name="category" class="form-control required" placeholder="Category" id="category">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Theme:</strong>
                            <input type="text" name="theme" class="form-control required" placeholder="Theme" id="theme">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Styles:</strong>
                            <input type="text" name="styles" class="form-control required" placeholder="Styles" id="styles">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Occasion :</strong>
                            <input type="text" name="occasion" class="form-control required" placeholder="Occasion " id="occasion">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Seasonality:</strong>
                            <input type="text" name="seasonality" class="form-control required" placeholder="Seasonality" id="seasonality">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Author:</strong>
                            <input type="text" name="author" class="form-control required" placeholder="Author" id="author">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Collection:</strong>
                            <input type="text" name="collection" class="form-control required" placeholder="Collection" id="collection">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Cuffs:</strong>
                            <input type="text" name="cuffs" class="form-control required" placeholder="Cuffs" id="cuffs">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Slits:</strong>
                            <input type="text" name="slits" class="form-control required" placeholder="Slits" id="slits">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Sleeves :</strong>
                            <input type="text" name="sleeves" class="form-control required" placeholder="Sleeves" id="sleeves">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Pockets:</strong>
                            <input type="text" name="pockets" class="form-control required" placeholder="Pockets" id="pockets">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Stitching:</strong>
                            <input type="text" name="stitching" class="form-control required" placeholder="Stitching" id="stitching">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Seams colour:</strong>
                            <input type="text" name="seams_colour" class="form-control required" placeholder="Seams colour" id="seams_colour">
                        </div>
                    </div>

                    <div class="form-group col-xs-6 col-sm-6 col-md-6 required">
                        <strong for="cars">Buttons:</strong>
                        <select name="template_buttons" id="template_buttons" class="form-control required">
                            <option>forms</option>
                            <option>colors</option>
                            <option selected="selected" value="">Select one</option>
                        </select>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group required">
                            <strong>Interlining:</strong>
                            <input type="text" name="interlining" class="form-control required" placeholder="Interlining" id="interlining">
                        </div>
                    </div>

                    <input type="hidden" name="categories_template_child" id="categories_template_child">
                    <input type="hidden" name="product_template_child" id="product_template_child">

                    <!-- <div class="form-group">
                    <input type="button" value="Valideaza" class="btn btn-primary generate-template-children-form">
                </div> -->

                </div>
                <!-- <div class="template_tab_generator" style="display: none">
            </div> -->

            </div>

        </div>
        <!-- childs area -->


    </div>
    <div style="overflow:auto; display:none" class="template_prev_next_btns">
        <div style="float:right;">
            <button type="button" id="template_prev_btn" style="display:none">Previous</button>
            <button type="button" id="template_next_btn">Next</button>
        </div>
    </div>
    <div style="text-align:center;margin-top:40px;" id="template-steps-area">
        <span class="step"></span>
    </div>

</form>



<!-- <form id="add-parent-form">
    <h3>Step 1</h3>
    <section>
        <label>Nume parinte:</label>
        <input type="text" name="name" id="name">
    </section>
    <h3>Step 2</h3>
    <section>
        <label>Copii:</label>
        <div id="children-fields">
            <div class="child-field">
                <input type="text" name="children[0][name]" placeholder="Nume copil">
                <input type="text" name="children[0][age]" placeholder="Varsta copil">
                <button type="button" class="add-category-button">Adauga Categorie</button>
                <div class="category-fields">
                    <div class="category-field">
                        <input type="text" name="children[0][categories][0][name]" placeholder="Nume categorie">
                        <input type="text" name="children[0][categories][0][description]" placeholder="Descriere categorie">
                    </div>
                </div>
            </div>
        </div>
        <button type="button" id="add-child-button">Adauga copil</button>
    </section>
    <button type="submit">Salveaza</button>
</form> -->

@endsection

<style>
    .template_tab {
        display: none;
    }
</style>

<ul>
  <li class="item">
    <span>Item 1</span>
  </li>
  <div class="add-container">
    <button class="add-button">Add</button>
  </div>
  <li class="item">
    <span>Item 2</span>
  </li>
  <div class="add-container">
    <button class="add-button">Add</button>
  </div>
  <!-- alte elemente item -->
</ul>