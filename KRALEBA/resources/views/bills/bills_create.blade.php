@extends('layouts.app')

@section('content')

    <head>

        <title>Creeaza Factura</title>
    </head>

    <body>

    @if ($errors->any())

        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>

    @endif

    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h3>Adauga Factura</h3>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('bills.index') }}"> Inapoi</a>
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
                        <input type="text" name="custumer_id" class="form-control" placeholder="Client Name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong> <i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Cod:</strong>
                        <input type="number" name="unique_code" class="form-control" placeholder="Cod">
                        @error('Cod')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Data
                            Facturarii:</strong>
                        @error('data facturarii')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <strong>Start Date</strong>
                        <input id="startdate" class="form-control col-md-2">
                        <strong>End Date </strong>
                        <input id="enddate" class="form-control col-md-2">
                    </div>

                    <script>
                        $(document).ready(function () {
                            $("#startdate").datepicker();
                            $("#enddate").datepicker();
                        });
                    </script>
                </div>

                <br>
                <br>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Numar:</strong>
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
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>TVA:</strong>
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
                        <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Tipul:</strong>
                        <select name="type" class="form-select" aria-label="Default select example">
                            <br>
                            <option value="1">Proforma</option>
                            <option value="2">Definitiva</option>
                        </select>
                    </div>
                </div>
                <br>
                <br>
                @include('bills.ware.ware1')
                @include('bills.ware.ware2')
                @include('bills.ware.ware3')
                @include('bills.ware.ware4')
                @include('bills.ware.ware5')

                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal 1</button>

                <div>
                    <button type="submit" class="btn btn-primary ml-3">Adauga Articol</button>
                </div>


            </div>
        </form>
    </div>
    </body>
@endsection
