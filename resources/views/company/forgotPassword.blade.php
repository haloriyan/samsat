@extends('layouts.auth')

@section('title', "Lupa Kata Sandi")

@section('content')
<form action="{{ route('app.forgotPassword.action') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <div class="icon">
            <i class="fas fa-envelope"></i>
        </div>
        <input type="email" name="email" placeholder="Email" required>
    </div>

    <button class="lebar-100 biru mt-3" onclick="clickBtn(this)">Atur Ulang Password</button>

    <div class="mt-3 rata-tengah">
        <div class="teks-transparan">sudah ingat password ?</div>
        <a href="{{ route('app.loginPage') }}">
            <button type="button" class="lebar-100 mt-3">Login</button>
        </a>
    </div>
</form>
@endsection