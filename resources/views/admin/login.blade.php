@extends('layouts.auth')

@section('title', "Login Admin")

@section('head.dependencies')
<style>
    .container {
        left: 35%;right: 35%;
    }
    .container .logo-sutra {
        height: 120px;
    }
    @media (max-width: 480px) {
        .container {
            left: 5%;right: 5%;
        }
        .container .logo-sutra {
            height: 200px;
        }
    }
</style>
@endsection

@section('content')
    <form action="{{ route('admin.login') }}" method="POST">
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
        <button class="lebar-100 biru mt-3">Login sebagai Admin</button>
    </form>
@endsection