@extends('layouts.app')

@section('content')

    <head>

        <title>Creeaza Factura</title>
    </head>


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

        <form action="{{ route('bills.store') }}" method="POST" id="regForm" enctype="multipart/form-data">
            @csrf
            <h1>Genereaza Factura:</h1>
            <!-- One "tab" for each step in the form: -->
            <div class="tab">
                <div class="parent_items0">

                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                        <strong><i class="fa fa-asterisk"
                                   style="font-size:7px;color:red; vertical-align: top;"></i>Client:</strong>

                        <select type="text" name="customer_id" class="form-control select2 customer-search"
                                oninput="this.className = 'form-control select2 customer-search'"> </select>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong> <i class="fa fa-asterisk"
                                        style="font-size:7px;color:red; vertical-align: top;"></i>Cod:</strong>
                            <input type="number" name="unique_code"
                                   class="form-control"
                                   placeholder="Cod"
                                   oninput="this.className = 'form-control' "
                            >
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Data
                                Facturarii:
                            </strong>
                            <input type="date" name="bill_date" class="form-control col-md-6"
                                   oninput="this.className = 'form-control col-md-6'"
                            >
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk"
                                       style="font-size:7px;color:red; vertical-align: top;"></i>Numar:</strong>
                            <input type="number" name="bill_number" class="form-control" placeholder="Numar"
                                   oninput="this.className = 'form-control' "
                            >
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Moneda:</strong>
                            <input class="form-control customer-coin" name="currency"
                                   oninput="this.className = 'form-control'"
                                   readonly
                            >
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk" style="font-size:7px;color:red; vertical-align: top;"></i>Curs
                                Valutar:</strong>
                            <input type="text" name="exchange" class="form-control" placeholder="Curs Valutar"
                                   oninput="this.className = 'form-control' ">

                        </div>
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                        <strong><i class="fa fa-asterisk"
                                   style="font-size:7px;color:red; vertical-align: top;"></i>TVA:</strong>
                        <input type="text" name="tva" class="form-control" placeholder="TVA"
                               oninput="this.className = 'form-control'">
                    </div>


                    <div class="form-group col-xs-12 col-sm-12 col-md-12">
                        <strong><i class="fa fa-asterisk"
                                   style="font-size:7px;color:red; vertical-align: top;"></i>#Articole:</strong>
                        <input type="number"
                               name="item"
                               class="form-control"
                               placeholder="#Articole:"
                               id="indexNumberOfArticle"
                               oninput="this.className = 'form-control'"

                        >
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong><i class="fa fa-asterisk"
                                       style="font-size:7px;color:red; vertical-align: top;"></i>Tipul:</strong>
                            <select name="type" class="form-select" aria-label="Default select example"
                                    onchange="this.className = 'form-control'">
                                <br>
                                <option value="1">Proforma</option>
                                <option value="2">Definitiva</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="parent_items1"></div>

            </div>


            <div id="article_form"></div>

            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;" id="steps-area">
                <span class="step"></span>


            </div>
        </form>
    </div>
@endsection

