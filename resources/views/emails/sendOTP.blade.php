<div style="background-color: #ecf0f1;padding: 25px;color: #444;">
    <div style="background-color: #fff;border: 1px solid #ddd;border-radius: 6px;padding: 20px;">
        <p style="font-size: 16px;line-height: 30px;margin: 10px 0px;">
            Halo, {{ $user->name }}
        </p>
        <p style="font-size: 16px;line-height: 30px;margin: 10px 0px;">
            Kode OTP Anda adalah <b>{{ $user->token }}</b>
        </p>
    </div>
</div>