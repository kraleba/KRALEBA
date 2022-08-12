@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editeaza Articolul <b> {{$ware['product_name']}}</b></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('wares.index', $customer['customer_id']) }}"> Renunta</a>
            </div>
        </div>
    </div>
    <br>

    <div>
        <form action="{{ route('wares.update', ['customer_id'=>$customer['customer_id'], 'ware'=>$ware['id']]) }}"
              method="POST">
            @csrf
            @method('PUT')
            <div>

                {{--                <label for="cars">Categorie</label>--}}

                <input type="hidden" name="customer_id" value="{{$customer['customer_id'] ?? ''}}">
{{--                <input type="hidden" name="status" value="0">--}}

                <select id="subcategorySelected" name="subcategory_id" onchange="showWareTemplate()"
                        class="form-control filter-control">
                    <option>Selecteaza o subcategorie</option>

                    @foreach($customer['category_id'] as $category)

                        @if($category['name'] != 'Textile')
                            <optgroup label="{{$category['name']}}">
                                @endif
                                @foreach($customer['subcategory_id'] as $subcategory)
                                    @if($category['category_id'] == $subcategory['category_id'])
                                        <option
                                            value="{{$subcategory['id']}}"
                                            @if($ware['subcategory_id'] == $subcategory['id'])
                                                selected
                                            @endif
                                        >
                                            {{$subcategory['name']}}
                                        </option>
                                    @endif
                                @endforeach
                            </optgroup>
                            @if($category['name'] == "Textile")
                                <option value="{{$category['category_id']}}"
                                        style="color: red"
                                        @if($ware['subcategory_id'] == 'Textile')
                                            selected
                                    @endif
                                >
                                    {{$category['name']}}
                                </option>
                            @endif
                            @endforeach

                </select>
            </div>
            <br>

            <div id="templateWare">
                <div class="col-xs-1 col-sm-12 col-md-5 show-subcategory">

                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Product
                                Name:</strong>
                            <input type="text" name="product_name" class="form-control"
                                   value="{{$ware['product_name'] ?? ''}}" placeholder="Product Name">
                            @error('Product name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Custom
                                code:</strong>
                            <input type="text" name="custom_code" class="form-control"
                                   value="{{$ware['custom_code'] ?? ''}}" placeholder="Custom code">
                            @error('Custom code')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div id="textileInputs"
                         @if($ware['subcategory_id'] != 'Textile')
                             style="display: none"
                        @endif
                    >

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Description:</strong>
                                <input type="text" name="description" class="form-control"
                                       value="{{$ware['description'] ?? ''}}"

                                       placeholder="Description">
                                @error('Description')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Composition:</strong>
                                <input type="text" name="composition" class="form-control"
                                       value="{{$ware['composition'] ?? ''}}" placeholder="Composition">
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
                                       value="{{$ware['material'] ?? ''}}"
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
                                       value="{{$ware['structure'] ?? ''}}"
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
                                       value="{{$ware['design'] ?? ''}}"
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
                                       value="{{$ware['weaving'] ?? ''}}"
                                       placeholder="weaving">
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
                                       value="{{$ware['color'] ?? ''}}"
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
                                       value="{{$ware['finishing'] ?? ''}}"
                                       placeholder="Finishing">
                                @error('Finishing')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Perceived
                                    weight:</strong>
                                <input type="text" name="perceived_weight" class="form-control"
                                       value="{{$ware['perceived_weight'] ?? ''}}"
                                       placeholder="Perceived weight">
                                @error('Perceived weight')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Softness:</strong>
                                <input type="text" name="softness" class="form-control"
                                       value="{{$ware['softness'] ?? ''}}"

                                       placeholder="Softness">
                                @error('Softness')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Look:</strong>
                                <input type="text" name="look" class="form-control" placeholder="Look"
                                       value="{{$ware['look'] ?? ''}}"
                                >
                                @error('Look')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Grounds:</strong>
                                <input type="text" name="grounds" class="form-control"
                                       value="{{$ware['grounds'] ?? ''}}"
                                       placeholder="Grounds">
                                @error('Grounds')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Weight in
                                    g/m2:</strong>
                                <input type="text" name="weight_in_g/m2" class="form-control"
                                       value="{{$ware['weight_in_g/m2'] ?? ''}}" placeholder="Weight in g/m2">
                                @error('Weight in g/m2')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Width
                                    (cm):</strong>
                                <input type="text" name="width" class="form-control"
                                       value="{{$ware['width'] ?? ''}}"
                                       placeholder="Width (cm)">
                                @error('Width (cm)')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Yarn number
                                    warp:</strong>
                                <input type="text" name="warp_th_per_cm" class="form-control"
                                       value="{{$ware['warp_th_per_cm'] ?? ''}}"
                                       placeholder="Yarn number warp">
                                @error('Yarn number warp')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Yarn count per cm
                                    warp:</strong>
                                <input type="text" name="warp_th_per_yarn_ne" class="form-control"
                                       value="{{$ware['warp_th_per_yarn_ne'] ?? ''}}"
                                       placeholder="Yarn count per cm warp">
                                @error('Yarn count per cm warp')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i> Yarn count per cm
                                    weft: </strong>
                                <input type="text" name="weft_p_per_cm" class="form-control"
                                       value="{{$ware['weft_p_per_cm'] ?? ''}}"
                                       placeholder="Yarn count per cm weft">
                                @error('Yarn count per cm weft')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Origin:</strong>
                                <input type="text" name="origin" class="form-control"
                                       value="{{$ware['origin'] ?? ''}}"
                                       placeholder="Origin">
                                @error('Origin')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Date:</strong>
                                <input type="text" name="date" class="form-control"
                                       value="{{$ware['date'] ?? ''}}"
                                       placeholder="Date">
                                @error('Date')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong><i class="fa fa-asterisk"
                                           style="font-size:7px;color:red; vertical-align: top;"></i>Rating:</strong>
                                <input type="text" name="rating" class="form-control"
                                       value="{{$ware['rating'] ?? ''}}"
                                       placeholder="Rating">
                                @error('Rating')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk"
                                       style="font-size:7px;color:red; vertical-align: top;"></i>Moneda:</strong>

                            <input type="hidden" name="coin" class="form-control" value="{{$coin['id'] ?? ''}}">
                            <input type="text" class="form-control"
                                   readonly="readonly"
                                   value="{{$coin['label'] ?? ''}}"
                                   placeholder="Moneda">
                            @error('Description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk"
                                       style="font-size:7px;color:red; vertical-align: top;"></i>UM:</strong>
                            <select name="UM" class="form-select"
                                    aria-label="Default select example">
                                <option selected>Selecteaza UM</option>
                                <option value="ml">ml</option>
                                <option value="gr">gr</option>
                                <option value="Kg">kg</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk"
                                       style="font-size:7px;color:red; vertical-align: top;"></i>Cantitatea:</strong>
                            <input type="text" name="amount" class="form-control"
                                   value="{{$ware['amount'] ?? ''}}"
                                   placeholder="Cantitatea">
                            @error('Description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Pret:</strong>
                            <input type="text" name="price" class="form-control" placeholder="Pret"
                                   value="{{$ware['price'] ?? ''}}"
                            >
                            @error('Cantitatea')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Editeaza</button>
                </div>
            </div>
        </form>
    </div>

@endsection
