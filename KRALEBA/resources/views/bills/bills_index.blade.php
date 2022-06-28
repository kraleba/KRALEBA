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
                    <h3>Facturii</h3>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('bills.create') }}"> Create a Bill</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <div>
        <h3> {{$filter_title ?? 'Toti clientii'}}</h3>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div>
        <ul class="list-body">
            @if($bills)

                @foreach ($bills as $bills)

                    <div class="list-group-item white-text rounded-pill" style=" border-radius: 0; height: 80px">
                        <div>
                            <!-- <b>{{ $bills->custumer_id }} </b> / -->
                            @if($bills->custumer_id)
                                /
                            @endif
                            {{ $bills->custumer_id }}

                            @if($bills->uniqueCode)
                                /
                            @endif
                            {{ $bills->uniqueCode }}
                            <!-- {{ $bills->uniqueCode }} -->

                            @if($bills->bill_date)
                                /
                            @endif
                            {{ $bills->bill_date }}

                            @if($bills->bill_number)
                                /
                            @endif
                            {{ $bills->bill_number }}

                            @if($bills->type)
                                /
                            @endif
                            {{ $bills->type }}
                        </div>
                        <div>
                            @if($bills->currency)
                                /
                            @endif
                            {{ $bills->currency }}

                            @if($bills->exchange)
                                /
                            @endif
                            {{ $bills->exchange }}

                            @if($bills->TVA)
                                /
                            @endif
                            {{ $bills->TVA }}

                            @if($bills->item)
                                /
                            @endif
                            {{ $bills->item }}

                        </div>

                        <div class="dropdown option-button">
                            <div class=" dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                 aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                     class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path
                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                </svg>
                            </div>
                            <form action="{{ route('bills.destroy',$bills->id) }}" method="POST">

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('bills.edit',$bills->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item">Delete</button>

                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                @endforeach
        </ul>
    </div>

    @else
        <div class="alert alert-warning">
            <h5>Nici un client!</h5>
        </div>
    @endif

@endsection



</body>

</html>
