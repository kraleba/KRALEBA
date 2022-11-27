<div>

    @if ($bills)
        @foreach ($bills as $bill)
            <table>

                <tr>
                    <th rowspan="2"></th>
                    <th rowspan="2">Product</th>
                    <th rowspan="2">Code</th>
                    <th rowspan="2">Description</th>
                    <th colspan="4"> buc./UM</th>
                    <th colspan="2">Total fara TVA</th>
                    <th colspan="2">TVA</th>
                    <th colspan="2">Total incl. TVA</th>
                </tr>
                <tr>
                    <th>UM</th>
                    <th>Cantit.</th>
                    <th>Euro</th>
                    <th>Lei</th>
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
                @foreach ($bill as $ware)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $ware['product_name'] }}</td>
                        <td>{{ $ware['custom_code'] }}</td>
                        <td>{{ $ware['description'] }}</td>
                        <td>{{ $ware['um'] }}</td>
                        <td>{{ $ware['amount'] }}</td>

                        {{-- pret pe bucata --}}
                        <td>{{ round($ware['price_euro'], 2) }}</td>
                        <td>{{ round($ware['price_lei'], 2) }}</td>

                        {{-- total pret fara tva EURO --}}
                        <td>{{ round($ware['amount'] * $ware['price_euro'] - ($ware['amount'] * $ware['price_euro'] * $ware['tva']) / (100 + $ware['tva']), 2) }}
                        </td>

                        {{-- total pret fara tva LEI --}}
                        <td>{{ round($ware['amount'] * $ware['price_lei'] - ($ware['amount'] * $ware['price_lei'] * $ware['tva']) / (100 + $ware['tva']), 2) }}
                        </td>

                        {{-- - TVA in eur- --}}
                        <td>{{ round(($ware['amount'] * $ware['price_euro'] * $ware['tva']) / (100 + $ware['tva']), 2) }}
                        </td>

                        {{-- TVA in lei --}}
                        <td>{{ round(($ware['amount'] * $ware['price_lei'] * $ware['tva']) / (100 + $ware['tva']), 2) }}
                        </td>

                        {{-- total pret tva --}}
                        <td>{{ round($ware['amount'] * $ware['price_euro'], 2) }}</td>
                        <td>{{ round($ware['amount'] * $ware['price_lei'], 2) }}</td>

                        @php
                            $eu_wit_out_tva += round($ware['amount'] * $ware['price_euro'] - ($ware['amount'] * $ware['price_euro'] * $ware['tva']) / (100 + $ware['tva']), 2);
                            $lei_wit_out_tva += round($ware['amount'] * $ware['price_lei'] - ($ware['amount'] * $ware['price_lei'] * $ware['tva']) / (100 + $ware['tva']), 2);

                            $eu_tva += round(($ware['amount'] * $ware['price_euro'] * $ware['tva']) / (100 + $ware['tva']), 2);
                            $lei_tva += round(($ware['amount'] * $ware['price_lei'] * $ware['tva']) / (100 + $ware['tva']), 2);

                            $eu_with_tva += round($ware['amount'] * $ware['price_euro'], 2);
                            $lei_with_tva += round($ware['amount'] * $ware['price_lei'], 2);

                        @endphp

                    </tr>
                    @php($i++)
                @endforeach
                <tr>
                    <td colspan="8"></td>
                    <td>{{ $eu_wit_out_tva }}</td>
                    <td>{{ $lei_wit_out_tva }}</td>
                    <td>{{ $eu_tva }}</td>
                    <td>{{ $lei_tva }}</td>
                    <td>{{ $eu_with_tva }}</td>
                    <td>{{ $lei_with_tva }}</td>

                </tr>

            </table>
        </br>
        @endforeach
    @else
        <h1> Ceva nu a mers bine si factura nu a putut fi generata!</h1>
    @endif
</div>
