@extends('layouts.app')

@section('title', "Notifikasi")

@section('head.dependencies')
<style>
    .item {
        border-bottom: 1px solid #ddd;
    }
    .item p {
        font-size: 15px;
        color: #666;
    }
</style>
@endsection

@section('header')
<header>
    <a href="{{ route('app.index') }}">
        <div class="ml-2 bagi lebar-30">
            <i class="fas fa-angle-left mr-1"></i> kembali
        </div>
    </a>
</header>
@endsection

@section('content')
    <div class="tinggi-40"></div>
    <h2>Notifikasi</h2>
    @foreach ($notifications as $notif)
        <a href="{{ $notif->route_action != null ? route($notif->route_action) : '#' }}">
            <div class="item">
                <p class="{{ $notif->has_read == 0 ? 'teks-tebal' : '' }}">{{ $notif->body }}</p>
            </div>
        </a>
    @endforeach
@endsection

@section('javascript')
<script>
    const readAllNotifications = () => {
        let req = post("{{ route('api.notification.read') }}", {
            company_id: "{{ $myData->id }}"
        })
        .then(res => {
            console.log("All notifications has read");
        });
    }

    readAllNotifications();
</script>
@endsection
