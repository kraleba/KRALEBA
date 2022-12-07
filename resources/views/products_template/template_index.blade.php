@extends('layouts.app')

@section('content')
    <div class="container">

        <div>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        {{-- <a class="btn btn-secondary" href="{{ route('templates.create') }}"> ADAUGA PROTOTIP</a> --}}
                    </div>
                </div>

            </div>
        </div>

        @include('products_template.template_filter')

        <!--end filter-->
        <br>

        {{--    @if ($customers) --}}
        {{--        <div> --}}
        {{--            <h3> {{$filter_title ?? 'Toti clientii'}}</h3> --}}
        {{--        </div> --}}
        {{--    @endif --}}

        <br>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($templates)
            <div>
                <ul class="list-body">
                    @foreach ($templates as $template)
                        <div class="list-group-item white-text rounded-pill" style=" border-radius: 0; height: 80px">

                            <div class="align">

                                <b>{{ $template->product_name }} </b> /

                                <a> {{ $template->id . '-' . $template->suffix . '/' . $template->number_of_child }} </a>


                                <div class="dropdown option-button">
                                    <div class=" dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                            <path
                                                d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                        </svg>
                                    </div>
                                    {{--                                    <form action="{{ route('template.destroy',$customer->id) }}" method="POST"> --}}

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item"
                                            href="{{ route('templates.show_template_child', ['parent_id' => $template->id, 'child_id' => $template->child_id]) }}">
                                            Vezi Prototipul
                                        </a>

                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item">Delete</button>

                                    </div>
                                    {{--                                    </form> --}}
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </ul>
            </div>
        @else
            <div class="alert alert-warning">
                <h5>Nici un prototip!</h5>
            </div>
        @endif
    </div>
@endsection
