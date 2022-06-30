@extends('layouts.app')

@section('content')

    <head>
        <meta charset="UTF-8">
        <title>Facturii</title>
    </head>

    <body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h3>Edit Bill</h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('bills.index') }}" enctype="multipart/form-data">Renunta</a>
                </div>
            </div>
        </div>
        <br>

        @if(session('status'))

            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>

        @endif

        <form action="{{ route('bills.update',$bill->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Client
                            Name:</strong>
                        <input type="text" name="name" value="{{ $bill->name }}" class="form-control"
                               placeholder="Client">
                        @error('Name Client')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Cod:</strong>
                        <input type="email" name="number" class="form-control" placeholder="Cod"
                               value="{{ $bill->cod }}">
                        @error('Cod')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Data
                            Facturarii:</strong>
                        <input type="text" name="data facturarii" value="{{ $bill->address }}" class="form-control"
                               placeholder="Data Facturarii:">
                        @error('Data Facturarii')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk"
                                   style="font-size:7px;color:red; vertical-align: top;"></i>Numar:</strong>
                        <input type="number" name="bill_number" class="form-control" placeholder="Numar">
                        @error('number')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Moneda:</strong>
                        <select name="currency" class="form-select" aria-label="Default select example">
                            <option selected>Selecteaza Moneda</option>
                            <br>
                            <option value="1">Lei</option>
                            <option value="2">Euro</option>
                            <option value="3">Dolari</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Curs
                            Valutar:</strong>
                        <input type="number" name="exchange" class="form-control" placeholder="Curs Valutar">
                        @error('number')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk"
                                   style="font-size:7px;color:red; vertical-align: top;"></i>TVA:</strong>
                        <input type="text" name="TVA" class="form-control" placeholder="TVA">
                        @error('tva')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>#Articole:</strong>
                        <input type="number" name="item" class="form-control" placeholder="#Articole">
                        @error('articole')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk"
                                   style="font-size:7px;color:red; vertical-align: top;"></i>Tipul:</strong>
                        <select name="type" class="form-select" aria-label="Default select example">
                            <br>
                            <option value="1">Proforma</option>
                            <option value="2">Definitiva</option>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Editeaza</button>
                </div>

            </div>
        </form>
    </div>
    </body>
@endsection
