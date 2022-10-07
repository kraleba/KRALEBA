@if($bills)

    <h3> {{$filter_title ?? 'Toate facturile!'}}</h3>

    @foreach($bills as $bill)

        <div class="list-group-item white-text rounded-pill" style=" border-radius: 0; height: 80px">

            <div class="align">

                <b>{{ $bill->name }} </b> /

                Data Facturari: {{ $bill->bill_date}}

                @if($bill->bill_number)
                    /
                @endif
                Numarul Facturi: {{ $bill->bill_number}}

                @if($bill->exchange)
                    /
                @endif
                Curs Valutar: {{ $bill->exchange}}

                @if($bill->tva)
                    /
                @endif
                Total incl. TVA: {{ $bill->tva}}

            </div>

        </div>

        <br>
    @endforeach
@else
    <h1>Nu s-a gasit nici o factura dupa aceste filtre</h1>
@endif
