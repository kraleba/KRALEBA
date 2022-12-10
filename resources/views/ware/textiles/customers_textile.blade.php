@extends('layouts.app')

@section('content')

    @include('ware.textiles.customers_textile_filters')

    <!--end filter-->

    <div class="clintes">
        @if ($wares)
            <h3 class="filter-selection"> {{ $filter_title ?? 'Textile' }}</h3>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($wares)
            <div>
                <ul class="list-body">
                    @foreach ($wares as $ware)
                    <div class="clients-group list-group-item">

                            <div class="align">

                                <b>{{ $ware->product_name }} </b> /

                                {{ $ware->custom_code }} 

                                @if ($ware->composition)
                                    /
                                @endif
                                Composition: {{ $ware->composition }}

                                @if ($ware->material)
                                    /
                                @endif
                                Material: {{ $ware->material }}

                                @if ($ware->structure)
                                    /
                                @endif
                                Structure: {{ $ware->structure }}

                                @if ($ware->design)
                                    /
                                @endif
                                Design: {{ $ware->design }}

                                @if ($ware->weaving)
                                    /
                                @endif
                                Weaving: {{ $ware->weaving }}

                                @if ($ware->color)
                                    /
                                @endif
                                Color: {{ $ware->color }}

                                @if ($ware->finishing)
                                    /
                                @endif
                                Finishing: {{ $ware->finishing }}

                                @if ($ware->perceived_weight)
                                    /
                                @endif
                                Perceived Weight: {{ $ware->perceived_weight }}

                                @if ($ware->softness)
                                    /
                                @endif
                                Softness: {{ $ware->softness }}
                                <br>

                                @if ($ware->look)
                                    
                                @endif
                                Look: {{ $ware->look }}

                                @if ($ware->grounds)
                                    /
                                @endif
                                Grounds: {{ $ware->grounds }}

                                @if ($ware->weight_in_g_m2)
                                    /
                                @endif
                                Weight in g/m2: {{ $ware->weight_in_g_m2 }}

                                @if ($ware->warp_th_per_cm)
                                    /
                                @endif
                                Warp th per cm: {{ $ware->warp_th_per_cm }}

                                @if ($ware->width)
                                    /
                                @endif
                                Width: {{ $ware->width }}

                                @if ($ware->warp_th_per_yarn_ne)
                                    /
                                @endif
                                Warp th per yarn ne: {{ $ware->warp_th_per_yarn_ne }}

                                @if ($ware->weft_p_per_cm)
                                    /
                                @endif
                                Weft p per cm: {{ $ware->weft_p_per_cm }}

                                @if ($ware->origin)
                                    /
                                @endif
                                Origin: {{ $ware->origin }}

                                @if ($ware->rating)
                                    /
                                @endif
                                Rating: {{ $ware->rating }}

                                @if ($ware->description)
                                    /
                                @endif
                                Description: {{ $ware->description }}
                                <br>

                                @if ($ware->date)
                                    
                                @endif
                                Date: {{ $ware->date }}
                                
                                @if ($ware->um)
                                /
                                @endif
                                UM: {{ $ware->um }}

                                @if ($ware->amount)
                                /
                                @endif
                                #  {{ $ware->amount }}

                                @if ($ware->price)
                                    /
                                @endif
                                Pret-Buc : {{ $ware->price}} 

                                @if ($ware->currency == 2)
                                    Euro  /                                 
                                @else
                                    Lei  /
                                @endif

                                @if ($ware->currency == 2)
                                Pret-Lei: {{ round($ware->price * $ware->exchange), 2 }} / 
                                @endif

                                @if ($ware->exchange)
                                @endif
                                 Curs Valutar: {{ $ware->exchange }}
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
@endsection
