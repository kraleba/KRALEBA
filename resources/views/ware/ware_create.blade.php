@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('wares.index', $customer['id']) }}"> Renunta</a>
            </div>
        </div>
    </div>
    <br>

    <div>
        <form action="{{ route('wares.store', $customer['id']) }}" method="POST">
            @csrf
            <div>
                <input type="hidden" name="customer_id" value="{{$customer['id']}}">
                <input type="hidden" name="status" value="0">

                <select name="categories_json" id="subcategorySelected" onchange="showWareTemplate()"
                        class="form-control filter-control">
                    <option>Selecteaza o subcategorie</option>

                    @foreach($customer_categories as $category)
                        @if($category['id'] != 8)
                            <optgroup label="{{$category['name'] ?? ''}}">
                                @endif
                                @foreach($customer['categories'] as $subcategory)
                                    @if($category['id'] == $subcategory->category_id)
                                        <option
                                            @if($subcategory->name == "Textile")
                                                style="color: red"
                                            @endif
                                            value="{{json_encode($subcategory)}}"
                                        >
                                            {{$subcategory->name}}
                                        </option>
                                    @endif
                                @endforeach
                                @if($category['id'] != 8)
                            </optgroup>
                        @endif
                    @endforeach

                </select>
            </div>
            <br>

            <div id="templateWare" style="display: none">
                <div class="col-xs-1 col-sm-12 col-md-5 show-subcategory">

                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk"
                                       style="font-size:7px;color:red; vertical-align: top;"></i>Product Name:</strong>
                            <input type="text" name="product_name" class="form-control"
                                   placeholder="Product Name">

                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk"
                                       style="font-size:7px;color:red; vertical-align: top;"></i>Custom code:</strong>
                            <input type="text" name="custom_code" class="form-control"
                                   placeholder="Custom code">

                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk"
                                       style="font-size:7px;color:red; vertical-align: top;"></i>Description:</strong>
                            <input type="text" name="description" class="form-control"
                                   placeholder="Description">

                        </div>
                    </div>

                    <div id="textileInputs">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Composition:</strong>
                                <input type="text" name="composition" class="form-control"
                                       placeholder="Composition">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Material
                                    :</strong>
                                <input type="text" name="material" class="form-control"
                                       placeholder="Material ">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Structure:</strong>
                                <input type="text" name="structure" class="form-control"
                                       placeholder="Structure">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Design:</strong>
                                <input type="text" name="design" class="form-control"
                                       placeholder="Design">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Weaving:</strong>
                                <input type="text" name="weaving" class="form-control"
                                       placeholder="Weaving">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Color:</strong>
                                <input type="text" name="color" class="form-control"
                                       placeholder="Color">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Finishing:</strong>
                                <input type="text" name="finishing" class="form-control"
                                       placeholder="Finishing">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Perceived
                                    weight:</strong>
                                <input type="text" name="perceived_weight" class="form-control"
                                       placeholder="Perceived weight">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Softness:</strong>
                                <input type="text" name="softness" class="form-control" placeholder="Softness">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Look:</strong>
                                <input type="text" name="look" class="form-control" placeholder="Look">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Grounds:</strong>
                                <input type="text" name="grounds" class="form-control" placeholder="Grounds">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Weight in
                                    g/m2:</strong>
                                <input type="text" name="weight_in_g/m2" class="form-control"
                                       placeholder="Weight in g/m2">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Width
                                    (cm):</strong>
                                <input type="text" name="width" class="form-control" placeholder="Width (cm)">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Yarn number
                                    warp:</strong>
                                <input type="text" name="warp_th_per_cm" class="form-control"
                                       placeholder="Yarn number warp">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Yarn count per cm
                                    warp:</strong>
                                <input type="text" name="warp_th_per_yarn_ne" class="form-control"
                                       placeholder="Yarn count per cm warp">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Yarn count per cm
                                    weft:</strong>
                                <input type="text" name="weft_p_per_cm" class="form-control"
                                       placeholder="Yarn count per cm weft">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Origin:</strong>
                                <input type="text" name="origin" class="form-control" placeholder="Origin">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Date:</strong>
                                <input type="text" name="date" class="form-control" placeholder="Date">

                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Rating:</strong>
                                <input type="text" name="rating" class="form-control" placeholder="Rating:">

                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Moneda:</strong>
                            <input type="hidden" name="coin" class="form-control" value="{{$coin['id'] ?? ''}}">
                            <input type="text" readonly='readonly' class="form-control" value="{{$coin['label'] ?? ''}}"
                                   placeholder="Moneda">

                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>UM:</strong>
                            <select name="um" class="form-select" aria-label="Default select example">
                                <option value="" selected> Selecteaza UM</option>
                                <option>bucati</option>
                                <option>ml</option>
                                <option>gr</option>
                                <option>kg</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Cantitatea:</strong>
                            <input type="text" name="amount" class="form-control" placeholder="Cantitatea">

                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Pret:</strong>
                            <input type="text" name="price" class="form-control" placeholder="Pret">

                        </div>
                    </div>

                </div>

                <button> Creaza Articol</button>
            </div>
        </form>
    </div>

@endsection
