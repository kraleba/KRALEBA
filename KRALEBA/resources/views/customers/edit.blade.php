@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editeazal pe {{$customers['name']}}</h2>
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

    <form action="{{ route('customers.update',$customers['id']) }}" method="POST">

        @csrf
        @method('PUT')

        @if($customers['type'] == 'provider')
            <div class="col-xs-1 col-sm-12 col-md-5">
                <strong>Categorii:</strong>
                <select name="category_id" id="department" class="form-control">
                    <option
                        value="{{$customers['category_id']['category_id'] }}">{{$customers['category_id']['name']}}
                    </option>

                    @foreach ($furnace_categories as $furnace_category)

                        <option value="{{$furnace_category->category_id}}">{{ $furnace_category->name }}</option>

                    @endforeach
                </select>

            </div>
            <br>

            <div class="col-xs-1 col-sm-12 col-md-6" style="padding-left: 130px;">
                <input type='text' autoComplete='none' name="subcategory" data-bs-toggle="dropdown" aria-expanded="false"
                           placeholder="Selecteaza o subcategorie" value="{{$customers['subcategory_id']['name'] ?? ''}}" class="form-control" id="dropdownInput"> </input>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                    @foreach ($subcategories as $subcategory)

                        <li>
                            <div>
                                <b class="dropdown-item list-subcategor"
                                   onclick="dropDownValue('subcategory' + {{$subcategory->subcategory_id}})"
                                   id="subcategory{{$subcategory->subcategory_id}}">{{$subcategory->name}}

                                    <a onclick="deleteSubcategory({{$subcategory->subcategory_id}})" id="optionDropdown"
                                       class="bi bi-trash">
                                        <div class="delete-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor"
                                                 class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd"
                                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </div>
                                    </a>

                                </b>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="customerOrProviderForm">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name"
                               value="{{$customers['name']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cod:</strong>
                        <input type="number" name="uniqueCode" class="form-control" placeholder="Cod"
                               value="{{$customers['uniqueCode']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Adresa:</strong>
                        <input type="text" name="address" class="form-control" placeholder="Adresa"
                               value="{{$customers['address']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cod Postal:</strong>
                        <input type="number" name="zipCode" class="form-control" placeholder="Cod Postal"
                               value="{{$customers['zipCode']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Oras :</strong>
                        <input type="text" name="city" class="form-control" placeholder="Oras"
                               value="{{$customers['city']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong>Tara:</strong>
                    <select name="country" id="department" class="form-control">
                        <option value="{{$customers['country']}}"> {{$countries[$customers['country']]}} </option>
                        @php($i = 1)
                        @foreach ($countries as $country)
                            @if($i != $customers['country'])
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
                               value="{{$customers['cif']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>OCR :</strong>
                        <input type="text" name="ocr" class="form-control" placeholder="OCR"
                               value="{{$customers['ocr']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>IBAN :</strong>
                        <input type="text" name="iban" class="form-control" placeholder="IBAN"
                               value="{{$customers['iban']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>SWIFT :</strong>
                        <input type="text" name="swift" class="form-control" placeholder="SWIFT"
                               value="{{$customers['swift']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>BANCA :</strong>
                        <input type="text" name="bank" class="form-control" placeholder="BANCA"
                               value="{{$customers['bank']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CONTACT :</strong>
                        <input type="text" name="contact" class="form-control" placeholder="CONTACT"
                               value="{{$customers['contact']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Telefon 1:</strong>
                        <input type="number" name="phone" class="form-control" placeholder="Telefon 1"
                               value="{{$customers['phone']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Telefon 2:</strong>
                        <input type="number" name="phone2" class="form-control" placeholder="Telefon 2"
                               value="{{$customers['phone2']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>e-mail:</strong>
                        <input type="text" name="email" class="form-control" placeholder="e-mail"
                               value="{{$customers['email']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>www:</strong>
                        <input type="text" name="www" class="form-control" placeholder="www"
                               value="{{$customers['www']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Note:</strong>
                        <input class="form-control" style="height:70px" name="note" placeholder="Note"
                               value="{{$customers['note']}}">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Creaza</button>
                </div>
            </div>
        </div>
    </form>

@endsection
<script>
    import InputError from "../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/InputError";

    export default {
        components: {InputError}
    }

</script>

