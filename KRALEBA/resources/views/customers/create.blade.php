@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
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

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="checkCustomer" name="type" onclick="checkBoxCustomer()"
                   value="customer">
            <label class="form-check-label" for="checkCustomer">Beneficiar</label>
        </div>


        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="checkProvider" name="type"
                   onclick="checkBoxProvider()" value="provider">
            <label class="form-check-label" for="check2">Furnizor</label>
        </div>

        <div class="col-xs-1 col-sm-12 col-md-5  show-subcategory" id="categoryProduct" style="padding-left: 65px; display: none">
            <strong>Categorii:</strong>
            <select name="category_id" id="category_id" class="form-control" onchange="showSubcategory(this)">
                <option value="0"> -- Selecteaza o categorie --</option>
                @foreach ($furnace_categories as $furnace_category)

                    <option value="{{$furnace_category->category_id}}">{{ $furnace_category->name }}</option>
                @endforeach
            </select>
        </div>


        <div class="col-xs-1 col-sm-12 col-md-6 dropdown"
             style="padding-left: 130px; display: none"
             id="subcategoryProduct"
        >
            <strong id="subcategory"></strong>

            <div class="searchable">
                <input type="text"
                       autoComplete='none'
                       name="subcategory"
                       class="show-subcategory"
                       placeholder="search countries"
                       onkeyup="filterFunction(this,event)">
                <ul id="ddlNationality">

                </ul>
            </div>
        </div>

        <div id="customerOrProviderForm" style="display: none">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">

                        <strong> <i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Name ">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Cod:</strong>
                        <input type="number" name="uniqueCode" class="form-control" placeholder="Cod ">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Adresa:</strong>
                        <input type="text" name="address" class="form-control" placeholder="Adresa">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Cod Postal:</strong>
                        <input type="number" name="zipCode" class="form-control" placeholder="Cod Postal">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Oras :</strong>
                        <input type="text" name="city" class="form-control" placeholder="Oras">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Tara:</strong>
                    <select name="country" id="department" class="form-control">
                        <option value=""> -- Selecteaza o tara --</option>
                        @php($i = 1)
                        @foreach ($countries as $country)
                            <option value="{{$i}}">{{ $country }}</option>
                            @php($i++)
                        @endforeach
                    </select>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CIF :</strong>
                        <input type="text" name="cif" class="form-control" placeholder="CIF">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>OCR :</strong>
                        <input type="text" name="ocr" class="form-control" placeholder="OCR">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>IBAN :</strong>
                        <input type="text" name="iban" class="form-control" placeholder="IBAN">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>SWIFT :</strong>
                        <input type="text" name="swift" class="form-control" placeholder="SWIFT">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>BANCA :</strong>
                        <input type="text" name="bank" class="form-control" placeholder="BANCA">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>CONTACT :</strong>
                        <input type="text" name="contact" class="form-control" placeholder="CONTACT">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Telefon 1:</strong>
                        <input type="number" name="phone" class="form-control" placeholder="Telefon 1">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Telefon 2:</strong>
                        <input type="number" name="phone2" class="form-control" placeholder="Telefon 2">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>e-mail:</strong>
                        <input type="text" name="email" class="form-control" placeholder="e-mail">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>www:</strong>
                        <input type="text" name="www" class="form-control" placeholder="www">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Note:</strong>
                        <textarea class="form-control" style="height:70px" name="note" placeholder="Note"></textarea>
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

