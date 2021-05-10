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

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            @auth
                <div class="bg-light border-right" id="sidebar-wrapper">
                    <div class="sidebar-heading">Kaspi-app</div>
                    <div class="list-group list-group-flush">

                        <a class="list-group-item list-group-item-action bg-light" href="{{route('home')}}">Информационная панель</a>
                        <a class="list-group-item list-group-item-action bg-light" href="{{route('equipment.show_warehouse')}}">Мой склад</a>
                        <a class="list-group-item list-group-item-action bg-light" href="{{route('equipment.show_incoming')}}">Входящие оборудования</a>
                        <a class="list-group-item list-group-item-action bg-light" href="{{route('equipment.show_add')}}">Добавить оборудование</a>
                        {{-- admin--}}
                        <a class="list-group-item list-group-item-action bg-light" href="{{route('equipment.show_warehouse')}}">Склады</a>
                        <a class="list-group-item list-group-item-action bg-light" href="#!">Движение оборудований</a>
                    </div>
                </div>
            @endauth

            <!-- Page Content-->
            <div id="page-content-wrapper">
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    @guest<a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>@endguest
                    @auth<button class="btn btn-primary" id="menu-toggle">Меню</button>@endauth
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @auth
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#!" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        Выйти
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                        @endauth
                    </div>
                </nav>
                <main class="py-4">
                    @include('partials.notification')
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
