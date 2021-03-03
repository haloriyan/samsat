<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fa/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('head.dependencies')
</head>
<body>
    
@yield('header')

<div class="container">
    @yield('content')
    <div class="tinggi-100"></div>
</div>

<nav class="navigation">
    <a href="{{ route('app.index') }}">
        <div class="bagi bagi-3">
            <div class="wrap">
                <i class="fas fa-home {{ Route::currentRouteName() == 'app.index' ? 'active' : '' }}"></i>
            </div>
        </div>
    </a>
    <div class="bagi bagi-3">
        <div class="wrap">
            <i class="fas fa-search"></i>
        </div>
    </div>
    <a href="{{ route('app.profile') }}">
        <div class="bagi bagi-3">
            <div class="wrap">
                <i class="fas fa-user {{ Route::currentRouteName() == 'app.profile' ? 'active' : '' }}"></i>
            </div>
        </div>
    </a>
</nav>

<script src="{{ asset('js/base.js') }}"></script>
@yield('javascript')

</body>
</html>