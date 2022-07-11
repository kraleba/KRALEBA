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
                        <input type="text" name="custumer_id" value="{{$customer['name'] ?? ''}}" class="form-control"
                               placeholder="Client Name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong> <i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Cod:</strong>
                        <input type="number" name="unique_code" value="{{$customer['uniqueCode'] ?? ''}}"
                               class="form-control"
                               placeholder="Cod">
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
                        <input id="startdate" value="{{date('d/m/Y')}}" class="form-control col-md-2">

                    </div>

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
                        <input class="form-control" value="{{$coin['label'] ?? ''}}">
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
                        <input type="number"
                               name="item"
                               id="indexNumberOfArticle"
                               class="form-control"
                               placeholder="#Articole"
                        >
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
                @include('bills.ware_modal.ware')

                <div>
                    <button type="button"
                            id="generateNumberOfArticle"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target=".ware-modal">
                        Adauga articol nou
                    </button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Creeaza</button>
                </div>
            </div>


        </form>

    </div>


    </body>
@endsection

