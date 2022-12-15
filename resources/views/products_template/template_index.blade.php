@extends('layouts.app')

@section('content')
    <div class="container">

        @include('products_template.template_filter')

        <!--end filter-->
        <br>
        <br>
        <br>
        <div class="clintes-p">
            {{-- @if ($customers) --}}
                <div>
                    <h4 class="filter-selection"> {{ $filter_title ?? 'Prototipuri:' }}</h4>
                </div>
            {{-- @endif --}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($templates)
            <div>
                <ul class="list-body">
                    @foreach ($templates as $template)
                    <div class="clients-group list-group-item">

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

                                        <a class="dropdown-item"
                                            href="{{ route('templates.show_template_table', ['parent_id' => $template->id, 'child_id' => $template->child_id]) }}">
                                            Vezi Tabelul
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
