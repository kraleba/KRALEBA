@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('customers.create') }}"> Creaza clinet</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Clienti</th>
            <th>#</th>
            <th width="180px">Status</th>
        </tr>
        {{--        @dd($customers)--}}
        @foreach ($customers as $customer)
            <tr>
                <td> {{ ++$i }} </td>
                <td>
                    <p>
                        <b>Nume: {{ $customer->name }} </b> /
                        <b>Cod: </b> {{ $customer->uniqueCode }} /
                        <b>Adresa: </b>{{ $customer->address }} /
                        <b>Oras: </b> {{ $customer->city }} /
                        <b>Cod postal: </b> {{ $customer->zipCode }} /
                        <b>Tara: </b> {{ $customer->country }} /
                        <b>CIF: </b> {{ $customer->cif }} /
                        <b>OCR: </b> {{ $customer->ocr }} /
                        <b>IBAN: </b> {{ $customer->iban }} /
                        <b>SWIFT: </b> {{ $customer->swift }} /
                        <b>Banca: </b> {{ $customer->bank }} /
                        <b>Teleon: </b> {{ $customer->phone }} /
                        <b>Telefon 2: </b> {{ $customer->phone2 }} /
                        <b>Tip client: </b> {{ $customer->type }} /
                        <b>Email: </b> {{ $customer->email }} /
                        <b>WWW: </b> {{ $customer->www }} /
                        <b>Detalii: </b> {{ $customer->note }}
                    </p>
                </td>

                <td>
                    <form action="{{ route('customers.destroy',$customer->id) }}" method="POST">

                        {{--                        <a class="btn btn-info" href="{{ route('customers.show',$customer->id) }}">Show</a>--}}

                        <a class="btn btn-primary" href="{{ route('customers.edit',$customer->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $customers->links() !!}
@endsection

