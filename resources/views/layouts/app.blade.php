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
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>

                    {{-- Contenuto dell offcanvas --}}
                    <div class="offcanvas-body">
                        <div>

                            {{-- Pulsante per la dashboard generale --}}
                            <div class="my-4">
                                <a class="my-btn" href="{{ route('user.dashboard')}}"><i class="fa-solid fa-chalkboard-user fs-4 me-2"></i><span class="fw-bold">Dashboard</span></a>
                            </div>

                            {{-- Pulsante per la pagina di appartamenti --}}
                            <div class="my-4">
                                <a class="my-btn " href="{{ route('user.apartment.index') }}"><i
                                        class="fa-solid fa-building-user fs-4 me-2"></i><span class="fw-bold">I tuoi
                                        appartamenti</span></a>
                            </div>
                            
                            {{-- Pulsante della pagina delle statistiche --}}
                            <div class="my-4">
                                <a class="my-btn" href=""><i
                                        class="fa-solid fa-chart-simple fs-4 me-2"></i></i><span
                                        class="fw-bold">Statistiche</span></a>
                            </div>
                            
                            {{-- Pulsante per la visualizzazione del profilo --}}
                            <div class="m">
                                <a class="my-btn" href="{{ route('user.profile.index') }}"><i
                                        class="fa-solid fa-user fs-4 me-2"></i><span class="fw-bold">Profilo</span></a>
                            </div>

                            {{-- Pulsante dell logout con form --}}
                            <div class="my-5">
                                <a class="logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
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
                        Logo
                    </div>
                    {{-- Contenitore per la gestione delle pagine --}}
                    <div class="border-bottom w-100 text-center text-xxl-start pb-2" id="nav-link">

                        {{-- Pulsante della dashboard generale --}}
                        <div class="my-4">
                            <a class="my-btn" href="{{ route('user.dashboard')}}"><i class="fa-solid fa-house fs-4 me-2"></i><span class="fw-bold d-none d-xxl-inline-block">Dashboard</span></a>
                        </div>

                        {{-- Pulsante per la pagina degli appartamenti --}}
                        <div class="my-4">
                            <a class="my-btn " href="{{ route('user.apartment.index') }}"><i
                                    class="fa-solid fa-building-user fs-4 me-2"></i><span
                                    class="fw-bold d-none d-xxl-inline-block">I tuoi appartamenti</span></a>
                        </div>

                        {{-- Pulsante per la pagina delle statistiche --}}
                        <div class="my-4">
                            <a class="my-btn" href=""><i class="fa-solid fa-chart-simple fs-4 me-2"></i></i><span
                                    class="fw-bold d-none d-xxl-inline-block">Statistiche</span></a>
                        </div>

                        {{-- Pulsante per la pagina del profilo --}}
                        <div class="my-4">
                            <a class="my-btn" href="{{ url('user/profile') }}"><i
                                    class="fa-solid fa-user fs-4 me-2"></i><span
                                    class="fw-bold d-none d-xxl-inline-block">Profilo</span></a>
                        </div>

                    </div>

                    {{-- Pulsante per il logout con il form --}}
                    <div>
                        <a class="logout" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
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
</body>

</html>
