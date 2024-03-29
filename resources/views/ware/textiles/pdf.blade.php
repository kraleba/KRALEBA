<div>
    @if($wares)
        <div>
            <h3> {{$filter_title ?? 'Textile'}}</h3>
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

                        <div class="dropdown option-button">
                            <div class=" dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path
                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                </svg>
                            </div>
                            <form
                                action="{{ route('wares.destroy', ['customer_id' => $ware->customer_id, 'ware' => $ware->id]) }}"
                                method="POST">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                    {{-- <a class="dropdown-item"
                                       href="{{ route('wares.edit', ['customer_id'=>$ware->customer_id, 'ware'=>$ware->id])}}">
                                        Edit
                                    </a> --}}


                                    {{-- @csrf
                                    @method('DELETE')
                                    <button class="dropdown-item">Delete</button> --}}

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
            <h5>Nici un textil!</h5>
        </div>
    @endif
</div>
