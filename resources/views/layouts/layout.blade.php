<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>@section('title')My Site @show</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/album/">



    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.1/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.1/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.1/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.1/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>
<body>

<header>
    @section('header')
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">About</h4>
                    <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Contact</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{route('home')}}" class="text-white">Follow Home</a></li>
                        <li><a href="{{route('page.about')}}" class="text-white">About</a></li>
                        <li><a href="{{route('posts.create')}}" class="text-white">Form</a></li>
                        <li><a href="{{route('send')}}" class="text-white">Send E-mail</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="{{route('home')}}" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <strong>Album</strong>
            </a>


        {{--     Проверка и показ ссылок в зависимости от того авторизован ли пользователь     --}}
{{--        @if(\Illuminate\Support\Facades\Auth::check()) {--}}
{{--            <a href="#">{{auth()->user()->name}}</a>--}}
{{--            <a href="{{route('logout')}}" class="text-white">Logout</a>--}}
{{--            }--}}
{{--            @else {--}}
{{--            <a href="{{route('register.create')}}" class="text-white">Register</a>--}}
{{--            <a href="{{route('login.create')}}" class="text-white">Login</a>--}}
{{--            }--}}

{{--        @endif--}}

{{--            То же самое только с использованием директив blade @auth/@guest --}}


            @auth
                <a href="#">
                    {{auth()->user()->name}}
                    @if(auth()->user()->avatar)
                        <img src="{{asset('storage/' . auth()->user()->avatar)}}" alt="" height="50">
                    @endif
                </a>
                <a href="{{route('logout')}}" class="text-white">Logout</a>
            @endauth

            @guest
                <a href="{{route('register.create')}}" class="text-white">Register</a>
                <a href="{{route('login.create')}}" class="text-white">Login</a>
            @endguest


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
    @show
</header>

<div class="container">
    @include('layouts.alerts')
</div>

<main>

@yield('content')

</main>

@include('layouts.footer')


<script src="{{asset('js/scripts.js')}}"></script>


</body>
</html>
