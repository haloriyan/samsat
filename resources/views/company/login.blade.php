@extends('layouts.auth')

@section('content')
    <form action="{{ route('app.login') }}" method="POST">
        {{ csrf_field() }}
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
        <button class="lebar-100 biru mt-3">Login</button>
    
        <div class="mt-3 rata-tengah">
            <div class="teks-transparan">belum punya akun?</div>
            <a href="{{ route('app.registerPage') }}">
                <button type="button" class="lebar-100 mt-3">Daftar</button>
            </a>
        </div>
    </form>
@endsection