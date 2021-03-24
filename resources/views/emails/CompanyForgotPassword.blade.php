<div style="background-color: #ecf0f1;padding: 25px;color: #444;">
    <div style="background-color: #fff;border: 1px solid #ddd;border-radius: 6px;padding: 20px;">
        <p style="font-size: 18px;line-height: 30px;margin: 10px 0px;">
            Halo, {{ $user->name }},
        </p>
        <p style="font-size: 18px;line-height: 30px;margin: 10px 0px;">
            Anda meminta untuk penggantian password pada aplikasi SAMSAT SUTRA GO
        </p>
        <p style="font-size: 18px;line-height: 30px;margin: 10px 0px;">
            <a href="{{ route('app.resetPassword', $token) }}">
                Link
            </a>
        </p>
        <p style="font-size: 18px;line-height: 30px;margin: 10px 0px;">
            Terima Kasih    
        </p>
    </div>
</div>