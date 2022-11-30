<div>
    @if ($wares)
        <div>
            <h3> {{ $filter_title ?? 'Toate articolele' }}</h3>
        </div>
    @endif

    @if ($wares)
        <div>
            <ul class="list-body">
                @foreach ($wares as $ware)
                    <div class="list-group-item white-text rounded-pill" style=" border-radius: 0; height: 80px">

                        <div class="align">

                            <b>{{ $ware->product_name }} </b> /

                            {{ $ware->custom_code }}

                            @if ($ware->description)
                                /
                            @endif
                            {{ $ware->description }}

                            @if ($ware->date)
                                /
                            @endif
                            {{ $ware->date }} /

                            {{-- @if ($ware->color)
                            /
                        {{-- @endif                                  nu stiu --}}
                            Curs Valutar: {{ $ware->coin }} / {{-- ???????????? --}}

                            UM: @if ($ware->um)
                            @endif
                            / Cantitate: {{ $ware->amount }}
                        </div>
                    </div>
                @endforeach
            </ul>
        </div>
    @else
        <div class="alert alert-warning">
            <h5>Nici un articol!</h5>
        </div>
    @endif


</div>
