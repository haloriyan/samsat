@extends('layouts.auth')

@section('title', "OTP Auth")

@section('content')
<form action="{{ route('app.otpAuth.action', $data->session_id) }}" method="POST">
    {{ csrf_field() }}
    <div class="mt-2">Masukkan Kode OTP :</div>
    <div class="form-group">
        <div class="icon">
            <i class="fas fa-key"></i>
        </div>
        <input type="number" name="token" placeholder="Kode yang dikirim melalui email" required>
    </div>

    <button class="mt-3 lebar-100 biru">
        Verifikasi OTP
    </button>
</form>
@endsection