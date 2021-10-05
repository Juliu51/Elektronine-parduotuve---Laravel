<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MegaShop') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Hind&family=Stick+No+Bills:wght@700&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light text-white shadow bg-body rounded">
            <div class="container">
                <a class="navbar-brand text-danger logo" href="{{ route('category.index') }}">
                   MegaShop
                </a>
                <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon bg-white"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto text-white">
                        <!-- Authentication Links -->
                        <li class="nav-item text-white">
                            <a class="nav-link text-white navName" href="{{ route('category.index') }}">Pagrindinis</a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white navName" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white navName" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        @if(Auth::user()->isAdmin())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white navName" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                               Prekės
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item navName "  href="{{ route('category.index') }}" >
                                    Prekių sąrašas
                                </a>
                                <a class="dropdown-item  navName"  href="{{ route('category.index') }}" >
                                   Pridėti prekę
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown navName" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                               Parametrai
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item navName"  href="{{ route('parameter.index') }}" >
                                    Parametrų sąrašas
                                </a>
                                <a class="dropdown-item navName"  href="{{ route('parameter.create') }}" >
                                   Pridėti parametrą
                                </a>
                            </div>
@else
<li class="nav-item text-white">
                            <a class="nav-link text-white navName"  href="{{ route('category.index') }}" >
                                    Prekės
                                </a>
                        </li>
@endif
                        <li class="nav-item text-white">
                            <a class="nav-link text-white navName" href="">Kontaktai</a>
                        </li>
                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                            <li class="nav-item text-white">
                            <a class="nav-link text-white navName" href="">🛒</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
        <div class="container">
                       <div class="row justify-content-center">
                           <div class="col-md-9">
                               @if ($errors->any())
                               <div class="alert">
                                   <ul class="list-group">
                                       @foreach ($errors->all() as $error)
                                           <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                                       @endforeach
                                   </ul>
                               </div>
                               @endif
                           </div>
                       </div>
                   </div>
                   <div class="container">
                       <div class="row justify-content-center">
                           <div class="col-md-9">
                               @if(session()->has('success_message'))
                                   <div class="alert alert-success" role="alert">
                                       {{session()->get('success_message')}}
                                   </div>
                               @endif
                               @if(session()->has('info_message'))
                                   <div class="alert alert-info" role="alert">
                                       {{session()->get('info_message')}}
                                   </div>
                               @endif
                           </div>
                       </div>
                   </div>
            @yield('content')
        </main>
    </div>
    <footer class="text-center text-white  footer shadow bg-body rounded">
  <!-- Grid container -->
  <!-- Copyright -->
  <div class="text-center p-3">
    © 2021 Copyright:
    <a class="text-white" href="{{ route('category.index') }}">MegaShop.com</a>
  </div>
  <!-- Copyright -->
</footer>
</body>
<script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
</html>
