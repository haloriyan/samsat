@extends('layouts.auth')

@section('title', "Verifikasi Pendaftaran")

@section('content')
    <form action="{{ route('app.otpAuth', $sessionID) }}" method="POST">
        {{ csrf_field() }}
        @if ($errors->count() != 0)
            @foreach ($errors->all() as $err)
                <div class="bg-merah-transparan rounded p-2">
                    {{ $err }}
                </div>
            @endforeach
        @endif
        @if ($message != "")
            <div class="bg-hijau-transparan rounded p-2">
                {{ $message }}
            </div>
        @endif
        <p class="teks-transparan">
            Mohon masukkan token verifikasi yang sudah dikirim ke email Anda
        </p>
        <div class="form-group">
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <input type="text" name="token" placeholder="Token" required>
        </div>
        
        <button class="lebar-100 biru mt-3" onclick="clickBtn(this)">Verifikasi</button>
        <div class="mt-3 rata-tengah">
            <div class="teks-transparan">tidak mendapat email?</div>
            <a href="{{ route('app.resendToken', $sessionID) }}">
                <button id="resendButton" style="opacity: 0.4" type="button" class="lebar-100 mt-3">kirim ulang token</button>
            </a>
        </div>
    </form>
@endsection

@section('javascript')
<script>
    const clickBtn = btn => {
        btn.innerHTML = "<i class='fas fa-spinner'></i> memproses..."
    }

    setTimeout(() => {
        select("#resendButton").style.opacity = 1;
        console.log('ada');
    }, 10000);
</script>
@endsection