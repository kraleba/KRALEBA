@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>{{ $customer['name']}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <br>

    <div class="list-group-item white-text rounded-pill" style=" border-radius: 0; height: 80px">
        <ul class="list-body">
            <div class="align" >
                <a href="{{ route('customers.show',$customer['id']) }}">

                <b>{{ $customer['name'] }} </b> /

                {{ $customer['uniqueCode'] }}


            </div>
{{--            <form action="{{ route('show.destroy',$customer['id']) }}" method="POST">--}}

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                    <a class="dropdown-item" href="{{ route('customers.edit',$customer['id']) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item">Delete</button>

                </div>
{{--            </form>--}}
        </ul>
    <div>
@endsection
