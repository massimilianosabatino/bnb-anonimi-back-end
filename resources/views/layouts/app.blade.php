<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @yield('script')
    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">

        {{-- Contenitore generale layout --}}
        <div class="row g-0" id="nav">

            {{-- Layout della pagina in formato mobile --}}
            <div class="col-12 d-flex justify-content-between align-items-center d-lg-none px-4" id="header">

                {{-- header dell formato mobile --}}
                <div class="fs-3">Ciao {{ Auth::user()->name }}</div>

                {{-- Pulsante dell offcanvas --}}
                <a class="btn fs-4 " data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                    aria-controls="offcanvasExample">
                    <i class="fa-solid fa-bars"></i>
                </a>

                {{-- Offcanvas dell layout mobile --}}
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                    aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">BoolBnB</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    {{-- Contenuto dell offcanvas --}}
                    <div class="offcanvas-body">
                        <div>

                            {{-- Pulsante per la dashboard generale --}}
                            <div class="my-4">
                                <a class="my-btn" href="{{ route('user.dashboard') }}"><i
                                        class="fa-solid fa-chalkboard-user fs-4 me-2"></i><span
                                        class="fw-bold">Dashboard</span></a>
                            </div>

                            {{-- Pulsante per la pagina di appartamenti --}}
                            <div class="my-4">
                                <a class="my-btn " href="{{ route('user.apartment.index') }}"><i
                                        class="fa-solid fa-building-user fs-4 me-2"></i><span
                                        class="fw-bold">Appartamenti</span></a>
                            </div>

                            {{-- Pulsante della pagina delle statistiche --}}
                            {{-- <div class="my-4">
                                <a class="my-btn" href=""><i class="fa-solid fa-chart-simple fs-4 me-2"></i><span
                                        class="fw-bold">Statistiche</span></a>
                            </div> --}}

                            {{-- Pulsante del sito front-end--}}
                            <div class="my-4">
                                <a class="my-btn" href="http:\\{{ env('URL_FRONT_END') }}"><i
                                        class="fa-solid fa-earth-europe fs-4 me-2"></i><span class="fw-bold">Vai al sito</span></a>
                            </div>

                            {{-- Pulsante dell logout con form --}}
                            <div class="my-5">
                                <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-arrow-right-from-bracket fs-4 me-2"></i><span
                                        class="fw-bold">Logout</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Layout della pagina in formato desktop --}}
            <div class="col-lg-1 col-xxl-2 d-none d-lg-block p-0 border-end">
                <div class="d-flex flex-column justify-content-between align-items-center" id="left-nav">
                    <div id="logo">
                        <a href="{{ route('user.dashboard') }}">
                            <img class="img-fluid" src="{{ url('logo.png') }}" alt="logo" srcset="">
                        </a>
                    </div>
                    {{-- Contenitore per la gestione delle pagine --}}
                    <ul class="border-bottom w-100 text-center text-xxl-start pb-2 list-unstyled" id="nav-link">

                        {{-- Pulsante della dashboard generale --}}
                        <li class="my-4">
                            <a class="my-btn" href="{{ route('user.dashboard') }}"><i
                                    class="fa-solid fa-house fs-4 me-2"></i><span
                                    class="fw-bold d-none d-xxl-inline-block">Dashboard</span></a>
                        </li>

                        {{-- Pulsante per la pagina degli appartamenti --}}
                        <li class="my-4">
                            <a class="my-btn " href="{{ route('user.apartment.index') }}"><i
                                    class="fa-solid fa-building-user fs-4 me-2"></i><span
                                    class="fw-bold d-none d-xxl-inline-block">Appartamenti</span></a>
                        </li>

                        {{-- Pulsante per la pagina delle statistiche --}}
                        {{-- <li class="my-4">
                            <a class="my-btn" href=""><i
                                    class="fa-solid fa-chart-simple fs-4 me-2"></i></i><span
                                    class="fw-bold d-none d-xxl-inline-block">Statistiche</span></a>
                        </li> --}}


                        {{-- Pulsante per la pagina della sponsorship --}}
                        {{-- <li class="my-4">
                            <a class="my-btn" href="{{ route('user.sponsorship.index') }}"><i
                                    class="fa-solid fa-star fs-4 me-2"></i><span
                                    class="fw-bold d-none d-xxl-inline-block">Sponsorship</span></a>
                        </li> --}}

                        {{-- Pulsante per la pagina del profilo --}}
                        <li class="my-4">
                            <a class="my-btn" href="{{ url('user/profile') }}"><i
                                    class="fa-solid fa-user fs-4 me-2"></i><span
                                    class="fw-bold d-none d-xxl-inline-block">Profilo</span></a>
                        </li>

                        {{-- Pulsante del sito front-end--}}
                        <li class="my-4">
                            <a class="my-btn" href="http:\\{{ env('URL_FRONT_END') }}"><i
                                    class="fa-solid fa-earth-europe fs-4 me-2"></i><span class="fw-bold d-none d-xxl-inline-block">Vai al sito</span></a>
                            </li>

                    </ul>

                    {{-- Pulsante per il logout con il form --}}
                    <div>
                        <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-arrow-right-from-bracket fs-4 me-2"></i><span
                                class="fw-bold d-none d-xxl-inline-block">Logout</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

            {{-- Conteiner adattivo per il contenuto della pagina --}}
            <div class="col-12 col-lg-11 col-xxl-10 p-0 m-0" id="content">
                @yield('content')
            </div>
        </div>
    </div>
    @yield('jsScript')
</body>

</html>