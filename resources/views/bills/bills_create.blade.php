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

                    <div class="form-group col-xs-12 col-sm-12 col-md-12 required">
                        <strong>Client:</strong>

                        <select type="text" name="customer_id"
                                class="form-select customer-search"
                                id="customer_select"
                        >
                        </select>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">
                        <strong>Cod:</strong>
                        <input type="number"
                               readonly
                               class="form-control"
                               placeholder="Cod"
                               id="show_customer_id_selected"
                               oninput="this.className = 'form-control' "
                        >
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">
                        <strong>Data
                            Facturarii:
                        </strong>
                        <input type="date" name="bill_date" class="form-control col-md-6"
                               oninput="this.className = 'form-control col-md-6'"
                        >
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">
                        <strong>Numar:</strong>
                        <input type="number" name="bill_number" class="form-control" placeholder="Numar"
                               oninput="this.className = 'form-control' "
                        >
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">
                        <strong></i>Moneda:</strong>
                        <input type="hidden" name="currency" id="customer-coin-id">
                        <input class="form-control" id="customer-coin-label"
                               oninput="this.className = 'form-control'"
                               readonly
                        >
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">
                        <strong>Curs Valutar:</strong>
                        <input type="number" name="exchange" class="form-control" placeholder="Curs Valutar"
                               oninput="this.className = 'form-control' ">
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-md-12 required">
                        <strong>TVA:</strong>
                        <input type="number" name="tva" class="form-control" placeholder="TVA"
                               oninput="this.className = 'form-control'">
                    </div>

                    <div class="form-group col-xs-12 col-sm-12 col-md-12 required">
                        <strong>#Articole:</strong>
                        <input type="number"
                               name="item"
                               class="form-control"
                               placeholder="#Articole:"
                               id="indexNumberOfArticle"
                               oninput="this.className = 'form-control'"
                        >
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 form-group required">
                        <strong>Tipul:</strong>
                        <select name="type" class="form-select"
                                onchange="this.className = 'form-control'">
                            <option disabled selected value> -- select an option --</option>
                            <option value="1">Proforma</option>
                            <option value="2">Definitiva</option>
                        </select>
                    </div>
                </div>
                <div class="parent_items1"></div>
                <div class="parent_items2"></div>

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

