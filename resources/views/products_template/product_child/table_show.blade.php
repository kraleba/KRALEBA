@extends('layouts.app')

@section('content')
<div>

    <p>Product Name: {{ $template_parent->product_name }}</p>
    {{-- <p>Code: {{$template_parent-> }}</p>  --}}
    {{-- <p>#Colors: {{$template_parent-> }}</p> --}}
    {{-- <p>This Product: {{$template_parent-> }}</p> --}}
    {{-- <p>Product # {{$template_parent-> }}</p> --}}
    @if ($template_parent)
        <table>

            <tr>
                <th>Furnizor</th>
                <th>Product Name</th>
                <th>Code</th>
                <th colspan="2">Factura</th>
                <th>UM</th>
                <th>Cantitate</th>
                <th>Euro</th>
                <th>Lei</th>
                <th colspan="2">Total fara TVA</th>
                <th colspan="2">TVA</th>
                <th colspan="2">Total incl. TVA</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th>Data</th>
                <th>Nr.</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Euro</th>
                <th>Lei</th>
                <th>Euro</th>
                <th>Lei</th>
                <th>Euro</th>
                <th>Lei</th>
            </tr>
            @php
                $i = 1;
                $eu_wit_out_tva = 0;
                $lei_wit_out_tva = 0;
                $eu_tva = 0;
                $lei_tva = 0;
                $eu_with_tva = 0;
                $lei_with_tva = 0;
            @endphp
            @foreach ($template_child as $child)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $child->product_name }}</td>
                    <td>{{ $child->custom_code }}</td>
                    <td>{{ $child->bill_date }}</td>
                    <td>{{ $child->bill_number }}</td>
                    <td>{{ $child->bill_number }}</td>
                    {{-- <td>{{ $child->um}}</td> --}}
                    <td>{{ $child->amount }}</td>
                    <td>{{ $child->amount }}</td>
                    <td>{{ $child->amount }}</td>
                    {{-- <td>{{ round($child['amount'] * $child['price_euro'] - ($child['amount'] * $child['price_euro'] * $child['tva']) / (100 + $child['tva']), 2) }} --}}
                    </td>

                </tr>
                {{-- @php($i++) 
        @endforeach  <tr>
        <td colspan="8"></td>
        <td>{{ $eu_wit_out_tva }}</td>
        <td>{{ $lei_wit_out_tva }}</td>
        <td>{{ $eu_tva }}</td>
        <td>{{ $lei_tva }}</td>
        <td>{{ $eu_with_tva }}</td>
        <td>{{ $lei_with_tva }}</td>

        </tr> --}}
            @endforeach
        </table>
        </br>
    @else
        <h1> Ceva nu a mers bine!</h1>
    @endif
</div>
@endsection