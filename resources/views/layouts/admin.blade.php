<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fa/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('js/flatpickr/dist/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/flatpickr/dist/themes/material_blue.css') }}">
    <style>
        #clearDate {
            margin-left: -35px;
            color: #e74c3c;
            cursor: pointer;
        }
    </style>
    @yield('head.dependencies')
</head>
<body>
    
<header class="bayangan-5 bg-putih">
    <div id="toggleMenu" onclick="toggleMenu()"><i class="fas fa-bars"></i></div>
    <img src="{{ asset('images/sutra-go.png') }}" alt="" class="logo">
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
        <a href="{{ route('admin.kendaraan') }}">
            <li class="{{ Route::currentRouteName() == 'admin.kendaraan' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-car"></i></div>
                <div class="text">Kendaraan Perusahaan</div>
            </li>
        </a>
        <a href="{{ route('admin.layananUnggulan') }}">
            <li class="{{ Route::currentRouteName() == 'admin.layananUnggulan' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-info"></i></div>
                <div class="text">Layanan Unggulan</div>
            </li>
        </a>
        <a href="{{ route('admin.kendaraanStatus') }}">
            <li class="{{ Route::currentRouteName() == 'admin.kendaraanStatus' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-file"></i></div>
                <div class="text">Laporan Status Kendaraan</div>
            </li>
        </a>
        {{-- <a href="{{ route('admin.pkb') }}">
            <li class="{{ Route::currentRouteName() == 'admin.pkb' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-calendar"></i></div>
                <div class="text">Pembayaran PKB Tahunan</div>
            </li>
        </a> --}}
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
        <a href="{{ route('admin.payment') }}">
            <li class="{{ Route::currentRouteName() == 'admin.payment' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-money-bill-alt"></i></div>
                <div class="text">Informasi Pembayaran</div>
            </li>
        </a>
        <a href="{{ route('admin.admin') }}">
            <li class="{{ Route::currentRouteName() == 'admin.admin' ? 'active' : '' }}">
                <div class="icon"><i class="fas fa-users"></i></div>
                <div class="text">User Admin</div>
            </li>
        </a>
    </div>
</nav>

<div class="content">
    <div class="wrap">
        @yield('content')
    </div>
    <div class="tinggi-65"></div>
</div>

<script src="{{ asset('js/base.js') }}"></script>
<script src="{{ asset('js/flatpickr/dist/flatpickr.min.js') }}"></script>
<script src="{{ asset('js/exporter.js') }}"></script>
<script src="{{ asset('js/storage.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
<script>
    let menu = select("nav.menu");
    let content = select(".content");
    let storage = new Storage("state");
    
    let state = storage.get("state");
    if (state == null) {
        storage.set({
            isMenuOpened: false,
        });
        menu.classList.remove('active');
        content.classList.remove('active');
    }
    if (state.isMenuOpened) {
        menu.classList.add('active');
        content.classList.add('active');
    }else {
        menu.classList.remove('active');
        content.classList.remove('active');
    }

    const toggleMenu = () => {
        menu.classList.toggle("active");
        content.classList.toggle("active");
        storage.set({
            isMenuOpened: !state.isMenuOpened
        });
    }
</script>
@yield('javascript')

</body>
</html>