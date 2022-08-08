@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('templates.index') }}"> Renunta</a>
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

    <form action="{{ route('templates.store') }}" method="POST">
        @csrf
        <div id="customerOrProviderForm">
            <div class="row" id="template_parent_box">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <label for="cars">Tipul:</label>
                    <select name="type" id="cars">
                        <option>Abelard</option>
                        <option>Heloise</option>
                    </select>
                </div>
                {{--                marketing_category_id--}}
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="cars">Marketing:</label>
                        <select name="marketing_category_id" id="cars">
                            @foreach($marketing_categories as $marketing_category)
                                <option value="{{$marketing_category->id}}">{{$marketing_category->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="cars">Style:</label>
                        <select name="marketing_category_id" id="cars">
                            @foreach($style_categories as $style_category)
                                <option value="{{$style_category->id}}">{{$style_category->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cuffs:</strong>
                        <input type="text" name="cuffs" class="form-control" placeholder="Cuffs">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Slits:</strong>
                        <input type="number" name="slits" class="form-control" placeholder="Slits">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Sleeves :</strong>
                        <input type="text" name="sleeves" class="form-control" placeholder="Sleeves">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Pockets:</strong>
                        <input type="text" name="pockets" class="form-control" placeholder="Pockets">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Stitching:</strong>
                        <input type="text" name="stitching" class="form-control" placeholder="Stitching">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Seams colour:</strong>
                        <input type="text" name="seams_colour" class="form-control" placeholder="Seams colour">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <label for="cars">Buttons:</label>
                        <select name="buttons" id="cars">
                            <option>forms</option>
                            <option>colors</option>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Interlining:</strong>
                        <input type="text" name="interlining " class="form-control" placeholder="Interlining">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Number of Products</strong>
                        <input type="number" name="number_of_child" class="form-control number_of_child"
                               placeholder="Number of Products">
                    </div>
                </div>
            </div>
            <input type="hidden" name="categories_template_child" id="categories_template_child">
            <input type="hidden" name="product_template_child" id="product_template_child">
            {{--create child--}}
            @include('products_template.product_child.template_child')
            {{--create child END --}}


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary child-salve">Salveaza</button>
            </div>
        </div>
    </form>
@endsection


