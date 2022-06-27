@extends('layouts.app')

@section('content')

<head>

    <title>Creeaza Factura</title>
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Adauga Factura</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('bills.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('bills.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Client:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Client Name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong> <i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Cod:</strong>
                        <input type="number" name="Cod" class="form-control" placeholder="Cod">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Data Facturarii:</strong>
                        <input type="text" name="data facturarii" class="form-control" placeholder="Data Facturarii">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Numar:</strong>
                        <input type="number" name="number" class="form-control" placeholder="Numar">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Moneda:</strong>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Selecteaza Moneda</option>
                            <option value="1">Lei</option>
                            <option value="2">Euro</option>
                            <option value="3">Dolari</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Curs Valutar:</strong>
                        <input type="number" name="curs valutar" class="form-control" placeholder="Curs Valutar">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>TVA:</strong>
                        <input type="text" name="tva" class="form-control" placeholder="TVA">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>#Articole:</strong>
                        <input type="number" name="articole" class="form-control" placeholder="#Articole">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Tipul</option>
                        <option value="1">Proforma</option>
                        <option value="2">Definitiva</option>
                    </select>
                </div>
                <br>
                <br>

                <div>
                    <button type="submit" class="btn btn-primary ml-3">Adauga Articol</button>
                </div>


            </div>
        </form>
    </div>
</body>
@endsection