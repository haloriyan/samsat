@extends('layouts.auth')

@section('title', "Login")

@section('content')
    <form action="{{ route('app.login') }}" method="POST">
        {{ csrf_field() }}
        @if ($errors->count() != 0)
            @foreach ($errors->all() as $err)
                <div class="bg-merah-transparan rounded p-2 mb-2">
                    {{ $err }}
                </div>
            @endforeach
        @endif
        <div class="form-group">
            <div class="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <div class="icon">
                <i class="fas fa-lock"></i>
            </div>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button class="lebar-100 biru mt-3" onclick="clickBtn(this)">Login</button>
    
        <div class="mt-3 rata-tengah">
            <div class="teks-transparan">belum punya akun?</div>
            <a href="{{ route('app.registerPage') }}">
                <button type="button" class="lebar-100 mt-3">Daftar</button>
            </a>
        </div>
    </form>

    <div class="mt-3 rata-tengah">
        <a href="{{ route('app.forgotPassword') }}">lupa kata sandi?</a>
    </div>
@endsection
