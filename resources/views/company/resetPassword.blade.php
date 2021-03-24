@extends('layouts.auth')

@section('content')
<h3>Atur Ulang Kata Sandi</h3>
<form action="{{ route('app.resetPassword.action', $companyID) }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <div class="icon">
            <i class="fas fa-lock"></i>
        </div>
        <input type="password" name="password" id="password" placeholder="Buat Kata Sandi Baru" required>
    </div>
    <div class="form-group">
        <div class="icon">
            <i class="fas fa-lock"></i>
        </div>
        <input type="password" name="retypePassword" id="retypePassword" oninput="checkPassword(this.value)" placeholder="Ulangi Kata Sandi Baru" required>
    </div>
    <div id="message"></div>

    <button type="button" id="btn" class="lebar-100 biru opacity-05 mt-3">Atur Ulang Password</button>
</form>
@endsection

@section('javascript')
<script>
    const checkPassword = retype => {
        let password = select("#password").value;
        let btnClassList = select("#btn");
        if (retype == password) {
            btn.classList.remove('opacity-05');
            btn.removeAttribute('type');
            btn.setAttribute('onclick', 'clickBtn(this)');
        }else {
            btn.classList.add('opacity-05');
            btn.setAttribute('type', 'button');
            btn.removeAttribute('onclick');
        }
    }
</script>
@endsection