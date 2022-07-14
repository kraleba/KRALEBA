@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                {{--                <h2>{{ $bill['name']}}</h2>--}}
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('customers.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <br>

    <div class="list-group-item">
        <ul class="list-body">
            <div class="align">
                {{--                <a href="{{ route('customers.show',$customer['id']) }}">--}}

                @foreach($generated_bills as $generated_bill)
                    <table class="table table-sm">
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Code</th>
                            <th>Description</th>
                            {{--                            <th style="text-align: center" colspan="2">buc./UM</th>--}}
                            <th>UM</th>
                            <th>Cantit.</th>
                            <th>Euro</th>
                            <th>Lei</th>
                            <th>Euro</th>
                            <th>Lei</th>

                        </tr>
                        @foreach($generated_bill as $ware)
                            <tr>
                                <td>1#</td>
                                <td>{{$ware->product_name}}</td>
                                <td>{{$ware->custom_code}}</td>
                                <td>{{$ware->design}}</td>
                                <td>{{$ware->amount}}</td>
                                <td>{{$ware->coin}}</td>
                                <td>{{$ware->product_name}}</td>
                                <td>{{$ware->product_name}}</td>
                                <td>{{$ware->product_name}}</td>
                                <td>{{$ware->product_name}}</td>

                            </tr>
                        @endforeach
                    </table>
                @endforeach

                {{--            <form action="{{ route('show.destroy',$customer['id']) }}" method="POST">--}}

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                    {{--                    <a class="dropdown-item" href="{{ route('customers.edit',$customer['id']) }}">Edit</a>--}}
                    @csrf
                    @method('DELETE')
                    <button class="dropdown-item">Delete</button>

                </div>
            {{--            </form>--}}
        </ul>
        <div>
@endsection

