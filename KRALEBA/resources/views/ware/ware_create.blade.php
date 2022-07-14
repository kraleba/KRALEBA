@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('wares.index', $customer['customer_id']) }}"> Renunta</a>
            </div>
        </div>
    </div>
    <br>

    <div>
        <form action="{{ route('wares.store', $customer['customer_id']) }}" method="POST">
            @csrf
            <div>

                {{--                <label for="cars">Categorie</label>--}}

                <input type="hidden" name="customer_id" value="{{$customer['customer_id']}}">
                <input type="hidden" name="status" value="0">

                <select name="subcategory_id" id="subcategorySelected" onchange="showWareTemplate()" class="form-control filter-control">
                    <option>Selecteaza o subcategorie</option>

                    @foreach($customer['category_id'] as $category)

                        @if($category['name'] != 'Textile')
                            <optgroup label="{{$category['name']}}">
                                @endif
                                @foreach($customer['subcategory_id'] as $subcategory)
                                    @if($category['category_id'] == $subcategory['category_id'])
                                        <option value="{{$subcategory['id']}}">{{$subcategory['name']}}</option>
                                    @endif
                                @endforeach
                            </optgroup>
                            @if($category['name'] == "Textile")
                                <option value="Textile"
                                        style="color: red">{{$category['name']}}</option>
                            @endif
                            @endforeach

                </select>
            </div>

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
                            @error('Product name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk"
                                       style="font-size:7px;color:red; vertical-align: top;"></i>Custom code:</strong>
                            <input type="text" name="custom_code" class="form-control"
                                   placeholder="Custom code">
                            @error('Custom code')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk"
                                       style="font-size:7px;color:red; vertical-align: top;"></i>Description:</strong>
                            <input type="text" name="description" class="form-control"
                                   placeholder="Description">
                            @error('Description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div id="textileInputs">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Composition:</strong>
                                <input type="text" name="composition" class="form-control"
                                       placeholder="Composition">
                                @error('Composition')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Material
                                    :</strong>
                                <input type="text" name="material" class="form-control"
                                       placeholder="Material ">
                                @error('Material ')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Structure:</strong>
                                <input type="text" name="structure" class="form-control"
                                       placeholder="Structure">
                                @error('Structure')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Design:</strong>
                                <input type="text" name="design" class="form-control"
                                       placeholder="Design">
                                @error('Design')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Weaving:</strong>
                                <input type="text" name="weaving" class="form-control"
                                       placeholder="Weaving">
                                @error('Weaving')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Color:</strong>
                                <input type="text" name="color" class="form-control"
                                       placeholder="Color">
                                @error('Color')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Finishing:</strong>
                                <input type="text" name="finishing" class="form-control"
                                       placeholder="Finishing">
                                @error('Finishing')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Perceived weight:</strong>
                                <input type="text" name="perceived_weight" class="form-control" placeholder="Perceived weight">
                                @error('Perceived weight')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Softness:</strong>
                                <input type="text" name="softness" class="form-control" placeholder="Softness">
                                @error('Softness')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Look:</strong>
                                <input type="text" name="look" class="form-control" placeholder="Look">
                                @error('Look')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Grounds:</strong>
                                <input type="text" name="grounds" class="form-control" placeholder="Grounds">
                                @error('Grounds')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Weight in g/m2:</strong>
                                <input type="text" name="weight_in_g/m2" class="form-control" placeholder="Weight in g/m2">
                                @error('Weight in g/m2')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Width (cm):</strong>
                                <input type="text" name="width" class="form-control" placeholder="Width (cm)">
                                @error('Width (cm)')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Yarn number warp:</strong>
                                <input type="text" name="warp_th_per_cm" class="form-control" placeholder="Yarn number warp">
                                @error('Yarn number warp')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Yarn count per cm warp:</strong>
                                <input type="text" name="warp_th_per_yarn_ne" class="form-control" placeholder="Yarn count per cm warp">
                                @error('Yarn count per cm warp')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Yarn count per cm weft:</strong>
                                <input type="text" name="weft_p_per_cm" class="form-control" placeholder="Yarn count per cm weft">
                                @error('Yarn count per cm weft')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Origin:</strong>
                                <input type="text" name="origin" class="form-control" placeholder="Origin">
                                @error('Origin')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Date:</strong>
                                <input type="text" name="date" class="form-control" placeholder="Date">
                                @error('Date')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Rating:</strong>
                                <input type="text" name="rating" class="form-control" placeholder="Rating:">
                                @error('Rating:')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Moneda:</strong>
                            <input type="text" name="coin" class="form-control" value="{{$coin['label'] ?? ''}}" placeholder="Moneda">
                            @error('Moneda')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>UM:</strong>
                            <select name="UM" class="form-select" aria-label="Default select example">
                                <option selected>Selecteaza UM</option>
                                <option value="1">ml</option>
                                <option value="2">gr</option>
                                <option value="3">kg</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Cantitatea:</strong>
                            <input type="text" name="amount" class="form-control" placeholder="Cantitatea">
                            @error('Cantitatea')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <button> Creaza Articol</button>
            </div>
        </form>
    </div>

@endsection
