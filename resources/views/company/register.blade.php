@extends('layouts.auth')

@section('title', "Pendaftaran")

@section('content')
    <form action="{{ route('app.register') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <input type="text" name="name" placeholder="Nama Perusahaan" required>
        </div>
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
        <div class="form-group">
            <div class="icon">
                <i class="fab fa-whatsapp"></i>
            </div>
            <input type="text" name="phone" placeholder="No. WhatsApp" required>
        </div>
        <div class="form-group">
            <div class="icon">
                <i class="fas fa-id-card"></i>
            </div>
            <input type="text" name="npwp" placeholder="NPWP Perusahaan" required>
        </div>
        <div class="form-group">
            <div class="icon">
                <i class="fas fa-map-marker"></i>
            </div>
            <input type="text" name="address" placeholder="Alamat" required>
        </div>
        <button class="lebar-100 biru mt-3" onclick="clickBtn(this)">Register</button>
    
        <div class="mt-3 rata-tengah">
            <div class="teks-transparan">sudah punya akun?</div>
            <a href="{{ route('app.loginPage') }}">
                <button type="button" class="lebar-100 mt-3">Login</button>
            </a>
        </div>
    </form>
    <div class="mt-3 rata-tengah">
        <a href="{{ route('app.forgotPassword') }}">lupa kata sandi?</a>
    </div>
@endsection
