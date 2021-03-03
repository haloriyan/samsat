<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fa/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('head.dependencies')
</head>
<body>
    
<header class="bg-biru">
    <div id="toggleMenu"><i class="fas fa-bars"></i></div>
    <h1>@yield('title')</h1>
</header>

<nav class="menu">
    <div class="wrap super">
        <a href="{{ route('admin.dashboard') }}">
            <li class="{{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-home"></i></div>
                <div class="text">Dashboard</div>
            </li>
        </a>
        <a href="{{ route('admin.companies') }}">
            <li class="{{ Route::currentRouteName() == 'admin.companies' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-briefcase"></i></div>
                <div class="text">Perusahaan Terdaftar</div>
            </li>
        </a>
        <a href="{{ route('admin.pkb') }}">
            <li class="{{ Route::currentRouteName() == 'admin.pkb' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-calendar"></i></div>
                <div class="text">Pembayaran PKB Tahunan</div>
            </li>
        </a>
        <a href="{{ route('admin.rju') }}">
            <li class="{{ Route::currentRouteName() == 'admin.rju' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-tags"></i></div>
                <div class="text">Retribusi Jasa Usaha</div>
            </li>
        </a>
        <a href="{{ route('admin.pap') }}">
            <li class="{{ Route::currentRouteName() == 'admin.pap' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-water"></i></div>
                <div class="text">Pajak Air Permukaan</div>
            </li>
        </a>
        <a href="{{ route('admin.pbbkb') }}">
            <li class="{{ Route::currentRouteName() == 'admin.pbbkb' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-oil-can"></i></div>
                <div class="text">Pajak Bahan Bakar</div>
            </li>
        </a>
    </div>
</nav>

<div class="container">
    @yield('content')
    <div class="tinggi-65"></div>
</div>

<script src="{{ asset('js/base.js') }}"></script>
@yield('javascript')

</body>
</html>