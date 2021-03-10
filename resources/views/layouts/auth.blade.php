<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fa/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <style>
        .logos {
            height: 50px;
            margin: 0px 15px;
        }
        .form-group {
            background-color: #ecf0f1;
            border-radius: 6px;
            padding: 0px 25px;
            height: 60px;
            margin-top: 15px;
        }
        .form-group .icon,
        .form-group input {
            display: inline-block;
            margin: -2px;
        }
        .form-group .icon {
            width: 14%;
            margin-top: 20px;
            font-size: 17px;
            color: #777;
        }
        .form-group input {
            width: 85%;
            height: 55px;
            margin-top: -5px;
            position: relative;
            top: -2px;
            border: none;
            background: none;
            color: #666;
        }
        .form-group input::-webkit-input-placeholder { color: #aaa; }
        .form-group input:focus {
            outline: none;
        }
    </style>
    @yield('head.dependencies')
</head>
<body>
    
<div class="container">
    <div class="rata-tengah">
        <img class="logos" src="{{ asset('images/polri.png') }}">
        <img class="logos" src="{{ asset('images/jatim.png') }}">
        <img class="logos" src="{{ asset('images/jasaraharja.png') }}">
    </div>
    <div class="logo-sutra tinggi-80 mt-3 mb-4" bg-image="{{ asset('images/sutra-go.png') }}"></div>
    @yield('content')
    <div class="tinggi-70"></div>
</div>

<script src="{{ asset('js/base.js') }}"></script>
@yield('javascript')

</body>
</html>