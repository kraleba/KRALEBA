@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())

        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach

    @endif

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
            <label class="form-check-label" for="check1">Beneficiar</label>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="check2" name="option2" value="something">
            <label class="form-check-label" for="check2">Furnizor</label>
        </div>

        categorie

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cod:</strong>
                    <input type="number" name="cod" class="form-control" placeholder="Cod">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Adress:</strong>
                    <input type="text" name="adress" class="form-control" placeholder="Adress">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Cod Postal:</strong>
                    <input type="number" name="cod postal" class="form-control" placeholder="Cod Postal">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Oras :</strong>
                    <input type="text" name="oras" class="form-control" placeholder="Oras">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tara:</strong>
                </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Selecteaza tara</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Romania</a>
                    <a class="dropdown-item" href="#">UE</a>
                    <a class="dropdown-item" href="#">non-UE</a>
                </div>
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
                    <input type="text" name="IBAN" class="form-control" placeholder="IBAN">
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
                    <input type="text" name="banca" class="form-control" placeholder="BANCA">
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
                    <input type="number" name="telefon 1" class="form-control" placeholder="Telefon 1">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Telefon 2:</strong>
                    <input type="number" name="telefon 2" class="form-control" placeholder="Telefon 2">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>e-mail:</strong>
                    <input type="text" name="e-mail" class="form-control" placeholder="e-mail">
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>

@endsection
