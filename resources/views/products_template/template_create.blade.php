@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
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
        <div id="customerOrProviderForm">

            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="radio" name="type" value="Abelard" id="template_gender_type">
                <label for="Abelard">Abelard</label>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <input type="radio" class="" name="type" value="Heloise" id="template_gender_type1">
                <label for="Heloise">Heloise</label>
            </div>

            <div class="row" id="template_parent_box" style="display: none">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Number of Products</strong>
                        <input type="number"
                               name="number_of_child"
                               class="form-control required number_of_child"
                               id="number_of_child"
                               placeholder="Number of Products"
                        >
                    </div>
                </div>

                <div class="form-group required">
                    <strong>Product Name</strong>
                    <input type="text" name="product_name" id="template_name" class="form-control required"
                           placeholder="Product Name">
                </div>

                <div class="form-group col-xs-12 col-sm-12 col-md-12 required">
                    <label for="marketing_category_id">Tayloring:</label>
                    <select class="form-control required" name="marketing_category_id" id="marketing_category_id"
                            required>
                        @foreach($marketing_categories as $marketing_category)
                            <option value="{{$marketing_category->id}}">{{$marketing_category->name}}</option>
                        @endforeach
                        <option selected="selected" value="">No category</option>
                    </select>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Category:</strong>
                        <input type="text" name="category" class="form-control required" placeholder="Category" id="category">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Theme:</strong>
                        <input type="text" name="theme" class="form-control required" placeholder="Theme" id="theme">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Styles:</strong>
                        <input type="text" name="styles" class="form-control required" placeholder="Styles" id="styles">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Occasion :</strong>
                        <input type="text" name="occasion" class="form-control required" placeholder="Occasion " id="occasion">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Seasonality:</strong>
                        <input type="text" name="seasonality" class="form-control required" placeholder="Seasonality" id="seasonality">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Author:</strong>
                        <input type="text" name="author" class="form-control required" placeholder="Author" id="author">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Collection:</strong>
                        <input type="text" name="collection" class="form-control required" placeholder="Collection" id="collection">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Cuffs:</strong>
                        <input type="text" name="cuffs" class="form-control required" placeholder="Cuffs" id="cuffs">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Slits:</strong>
                        <input type="text" name="slits" class="form-control required" placeholder="Slits" id="slits">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Sleeves :</strong>
                        <input type="text" name="sleeves" class="form-control required" placeholder="Sleeves"
                               id="sleeves">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Pockets:</strong>
                        <input type="text" name="pockets" class="form-control required" placeholder="Pockets"
                               id="pockets">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Stitching:</strong>
                        <input type="text" name="stitching" class="form-control required" placeholder="Stitching"
                               id="stitching">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Seams colour:</strong>
                        <input type="text" name="seams_colour" class="form-control required" placeholder="Seams colour"
                               id="seams_colour">
                    </div>
                </div>

                <div class="form-group col-xs-12 col-sm-12 col-md-12 required">
                    <strong for="cars">Buttons:</strong>
                    <select name="template_buttons" id="template_buttons" class="form-control required">
                        <option>forms</option>
                        <option>colors</option>
                        <option selected="selected" value="">Select one</option>
                    </select>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group required">
                        <strong>Interlining:</strong>
                        <input type="text" name="interlining" class="form-control required" placeholder="Interlining"
                               id="interlining">
                    </div>
                </div>

                <input type="hidden" name="categories_template_child" id="categories_template_child">
                <input type="hidden" name="product_template_child" id="product_template_child">

                <div class="form-group">
                    <input type="button" value="Valideaza" class="btn btn-primary generate-template-children-form">
                </div>
                {{--create child--}}
                @include('products_template.product_child.template_child')
                {{--create child END --}}

            </div>

            <div class="col text-center">
                <div class="form-group">
                    <button type="submit" style="display: none" id="salve_parent_product"
                            class="btn btn-primary child-salve">Salveaza
                    </button>
                </div>
                <div class="form-group">
                    <a class="btn btn-danger" href="{{ route('templates.index') }}"> Renunta</a>
                </div>
            </div>
        </div>
    </form>
@endsection


