@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editeazal pe {{$customers->name}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customers.index') }}"> Renunta</a>
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

    <form action="{{ route('customers.update',$customers->id) }}" method="POST">

        @csrf
        @method('PUT')

        @if($customers->type == 'provider')

            <input type="hidden" name="customer_id" value="{{ $customers->id }}">

            <div class="col-xs-1 col-sm-12 col-md-5 show-subcategory">

                <strong id="category"
                        @php
                            $categories = array();
                            $i = 0;
                                foreach($customers->categories as $category) {
                                    $categories[$category->category_id] =(array)$category->category_id;
                                    $i++;
                                }
                        @endphp
                        customer_id="{{$customers->id}}"
                        categories="{{ json_encode($customers->categories) }}"
                >Categorii:</strong>
                <br>

                @foreach ($furnace_categories as $furnace_category)
                    <input type="checkbox"
                           id="category_id {{$furnace_category->id}}"
                           onclick="showSubcategoryByCategoryId({{$furnace_category->id}}, {{ json_encode($customers->categories) }})"
                           name="categories_id[]"
                           value="{{ $furnace_category->id }}"
                           @if($categories[$furnace_category->id] ?? ''== $furnace_category->id)
                               checked
                        @endif
                    >
                    <label>{{ $furnace_category->name }}</label>

                    <br>

                    <div class="card subcategory-card" id="subcategory{{$furnace_category->id}}">
                        <div id="subcategory_list{{$furnace_category->id}}"></div>

                        <div id="category_id{{$furnace_category->id}}" style="display: none">
                            @if($furnace_category->id != 8)

                                <input placeholder="add subcategory" type="text"
                                       id="subcategoryLabel {{$furnace_category->id}}">
                                <input onclick="addSubcategoryForCustomersId({{$furnace_category->id}})"
                                       type="button" value="Add">

                            @endif
                        </div>
                    </div>

                @endforeach
            </div>


            <div class="col-xs-1 col-sm-12 col-md-6" style="padding-left: 130px;">

                {{--                <div class="searchable">--}}
                {{--                    <input type="text"--}}
                {{--                           autoComplete='none'--}}
                {{--                           name="subcategory"--}}
                {{--                           class="show-subcategory"--}}
                {{--                           value="{{$customers['subcategory_id']['name'] ?? ''}}" placeholder="search countries"--}}
                {{--                           onkeyup="filterFunction(this,event)">--}}
                {{--                    <ul id="ddlNationality">--}}

                {{--                    </ul>--}}
                {{--                </div>--}}


            </div>
        @endif
        <div id="customerOrProviderForm">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name"
                               value="{{$customers->name}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Cod:</strong>
                        <input type="number" name="unique_code" class="form-control" placeholder="Cod"
                               value="{{$customers->unique_code}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Adresa:</strong>
                        <input type="text" name="address" class="form-control" placeholder="Adresa"
                               value="{{$customers->address}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cod Postal:</strong>
                        <input type="number" name="zip_code" class="form-control" placeholder="Cod Postal"
                               value="{{$customers->zip_code}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Oras
                            :</strong>
                        <input type="text" name="city" class="form-control" placeholder="Oras"
                               value="{{$customers->city}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong><i class="fa fa-asterisk"
                               style="font-size:7px;color:red; vertical-align: top;"></i>Tara:</strong>
                    <select name="country" id="department" class="form-control">
                        <option value="{{$customers->country}}"> {{$countries[$customers->country]}} </option>
                        @php($i = 1)
                        @foreach ($countries as $country)
                            @if($i != $customers->country)
                                <option value="{{$i}}">{{ $country }}</option>
                            @endif
                            @php($i++)
                        @endforeach
                    </select>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CIF :</strong>
                        <input type="text" name="cif" class="form-control" placeholder="CIF"
                               value="{{$customers->cif}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>OCR :</strong>
                        <input type="text" name="ocr" class="form-control" placeholder="OCR"
                               value="{{$customers->ocr}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>IBAN :</strong>
                        <input type="text" name="iban" class="form-control" placeholder="IBAN"
                               value="{{$customers->iban}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>SWIFT :</strong>
                        <input type="text" name="swift" class="form-control" placeholder="SWIFT"
                               value="{{$customers->swift}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>BANCA :</strong>
                        <input type="text" name="bank" class="form-control" placeholder="BANCA"
                               value="{{$customers->bank}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CONTACT :</strong>
                        <input type="text" name="contact" class="form-control" placeholder="CONTACT"
                               value="{{$customers->contact}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Telefon 1:</strong>
                        <input type="number" name="phone" class="form-control" placeholder="Telefon 1"
                               value="{{$customers->phone}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Telefon 2:</strong>
                        <input type="number" name="phone2" class="form-control" placeholder="Telefon 2"
                               value="{{$customers->phone2}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>e-mail:</strong>
                        <input type="text" name="email" class="form-control" placeholder="e-mail"
                               value="{{$customers->email}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>www:</strong>
                        <input type="text" name="www" class="form-control" placeholder="www"
                               value="{{$customers->www}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Note:</strong>
                        <input class="form-control" style="height:70px" name="note" placeholder="Note"
                               value="{{$customers->note}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Editeaza</button>
                </div>
            </div>
        </div>
    </form>

@endsection


