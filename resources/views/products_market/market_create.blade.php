@extends('layouts.app')

@section('content')

    <form action="{{ route('market.index') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="type">Tipul</label>
                <select name="type" class="form-select">
                    <option>Real</option>
                    <option>Virtual</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="market_category">Categorii</label>
                <select name="market_category" class="form-select">
                    <option>Vanzare</option>
                    <option>Model</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="order_date">Data Comenzii</label>
                <input type="date" name="order_date" class="form-control" id="inputAddress" placeholder="">
            </div>

            <div class="form-group col-md-6">
                <label for="delivery_date">Data Livrarii</label>
                <input type="date" name="delivery_date" class="form-control" id="inputAddress" placeholder="">
            </div>
            {{--nu stiu aici inca ce e--}}
            <div class="form-group col-md-0">
                <input type="radio" id="html" name="fav_language" value="HTML">
                <label for="html">Partiale</label>
            </div>

            <div class="form-group col-md-6">
                <input type="radio" id="css" name="fav_language" value="CSS">
                <label for="css">Totale</label>
            </div>
            {{--nu stiu aici inca ce e end--}}

            <div class="form-group col-md-6">
                <label for="production_batch_code">Codul lotului de produs</label>
                <input type="text" name="production_batch_code" class="form-control" id="inputAddress2" placeholder="">
            </div>

            <div class="form-group col-md-6">
                <label for="selected_products">#produse SELECTATE</label>
                <input type="text" class="form-control" name="selected_products" id="inputAddress2" placeholder="">
            </div>

            <div class="form-group col-md-6">
                <label for="product_name">Numele produsului</label>
                <input type="text" name="product_name" class="form-control" id="find_product_name" placeholder="">
            </div>

            <div class="form-group col-md-6">
                <label for="inputAddress2">Codul produsului</label>
                <input type="text" class="form-control" id="test3" placeholder="">
            </div>

            <div class="form-group col-md-6">
                <label for="manufactured_products">Produse fabricate</label>
                <input type="text" name="manufactured_products" class="form-control" id="inputAddress2" placeholder="">
            </div>

            {{--aici trebueie sa vad cum trebuie facut mai exact--}}
            <div class="form-group col-md-6">
                <label for="inputEmail4">Curieri</label>
                <select name="" class="form-select">
                    <option>....</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="inputEmail4">Banci</label>
                <select name="" class="form-select">
                    <option>....</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="inputEmail4">Taxe</label>
                <select name="" class="form-select">
                    <option>....</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="inputEmail4">Altele</label>
                <select name="" class="form-select">
                    <option>....</option>
                </select>
            </div>
            {{--aici trebueie sa vad cum trebuie facut mai exact end--}}

        </div>

        <button type="submit" class="btn btn-primary">Creaza</button>
    </form>
@endsection
