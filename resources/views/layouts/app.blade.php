<!doctype html>
<html class="html-all" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/admin/customer.js') }}" defer></script>
    <script src="{{ asset('js/admin/bills.js') }}" defer></script>
    <script src="{{ asset('js/admin/ware.js') }}" defer></script>
    <script src="{{ asset('js/admin/ware_textile.js') }}" defer></script>
    <script src="{{ asset('js/admin/template_product.js') }}" defer></script>
    <script src="{{ asset('js/admin/product_marketing.js') }}" defer></script>
    <script src="{{ asset('js/admin/admin_helper.js') }}" defer></script>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    {{-- end scripts --}}


    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/cs s/all.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/customers.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bills.css') }}" rel="stylesheet">
    <link href="{{ asset('css/textil.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    {{--  style filter card  --}}
    <link href="{{ asset('css/filter_card.css') }}" rel="stylesheet">

</head>
{{-- <img src="{{ asset('background/simple.jpg')}}" width="100px"> --}}

<body class="body-p">
    <div id="app">
        <div class=" navbar-expand-md">
        
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', '') }}
            </a>
            {{--@dump(Auth::guard()->user()->type)--}}

            @if(isset(Auth::guard()->user()->type) && Auth::guard()->user()->type == 'admin')
                <div class="navbar-nav ">
                    <div class="nav-item">
                        <a class="nav-link" href="{{ url('admin/customers') }}"><b>Clienti</b></a>
                    </div>

                    <div class="nav-item dropdown navbar-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b>Cheltueli de productie </b>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ url('admin/bills') }}">Facturi</a>
                            <a class="dropdown-item " href="{{ url('admin/wares') }}">Articole</a>
                            <a class="dropdown-item" href="{{ url('admin/textile') }}">Textile</a>

                        </div>
                    </div>

                    <div class="nav-item">
                        <a class="nav-link" href="{{ url('admin/templates') }}"><b>Prototipuri</b></a>
                    </div>
                    
                    <div class="nav-item">
                        <a style="color: red" class="nav-link" href="{{ url('admin/market') }}"><b>Productie</b></a>
                    </div>
                </div>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        {{-- @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif --}}
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
            {{-- @dump(Auth::guard()->user()->type) --}}

            @if (isset(Auth::guard()->user()->type) && Auth::guard()->user()->type == 'admin')
                <div class="form-control nav-css">
                    <div class="navbar-nav justify-content-center">
                        <div class="nav-item">
                            <a class="nav-link" href="{{ url('admin/customers') }}"><b>Clienti</b></a>
                        </div>

                        <div class="nav-item dropdown navbar-dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: red">
                                <b>Cheltueli de productie </b>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ url('admin/bills') }}">Facturi</a>
                                <a class="dropdown-item " href="{{ url('admin/wares') }}">Articole</a>
                                <a class="dropdown-item" href="{{ url('admin/textile') }}">Textile</a>

                            </div>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link" href="{{ url('admin/templates') }}"><b>Prototipuri</b></a>
                        </div>

                        <div class="nav-item">
                            <a class="nav-link" href="{{ url('admin/market') }}"><b>Productie</b></a>
                        </div>
                    </div>
            @endif
        </div>
    </div>
    </nav>

    <main class="py-4 container">
        @yield('content')
    </main>

    </div>
</body>

</html>
