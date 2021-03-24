<div style="background-color: #ecf0f1;padding: 25px;color: #444;">
    <div style="background-color: #fff;border: 1px solid #ddd;border-radius: 6px;padding: 20px;">
        <p style="font-size: 18px;line-height: 30px;margin: 10px 0px;">
            Halo, {{ $user->name }}, selamat datang di TakoToko!
        </p>
        <p style="font-size: 18px;line-height: 30px;margin: 10px 0px;">
            Sebelum Anda dapat beristirahat dari menjawab pertanyaan melelahkan, Anda harus memverifikasi akun dengan klik tautan di bawah ini
        </p>
        <p style="font-size: 18px;line-height: 30px;margin: 10px 0px;">
            <a href="{{ route('shop.verification', $encodedEmail) }}">
                Link
            </a>
        </p>
        <p style="font-size: 18px;line-height: 30px;margin: 10px 0px;">
            Terima Kasih    
        </p>
    </div>
</div>