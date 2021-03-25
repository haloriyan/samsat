@extends('layouts.admin')

@section('title', "User Admin")

@section('content')
<div class="mb-4">
    <div class="bagi lebar-65">
        <form action="{{ route('admin.admin') }}">
            <input type="text" class="box" name="q" placeholder="Cari admin..." value="{{ $req->q }}">
            @if ($req->q != "")
                <a href="{{ route('admin.admin') }}" id="clearDate"><i class="fas fa-times"></i></a>
            @endif
        </form>
    </div>
    <div class="bagi lebar-35 rata-kanan">
        <button class="hijau mt-1" onclick="munculPopup('#addAdmin')">
            <i class="fas fa-plus mr-1"></i> Tambah Admin
        </button>
    </div>
</div>

@if ($message != "")
    <div class="bg-hijau-transparan rounded p-2 mb-2">
        {{ $message }}
    </div>
@endif

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th class="lebar-25"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin)
            <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    <span class="pointer bg-hijau rounded p-1 pl-2 pr-2" onclick="edit('{{ $admin }}')">
                        <i class="fas fa-edit"></i>
                    </span>
                    @if ($admin->id != $myData->id)
                        <a href="{{ route('admin.delete', $admin->id) }}" onclick="return confirm('Yakin ingin menghapus admin ini?')" class="bg-merah rounded p-1 pl-2 pr-2 ml-1">
                            <i class="fas fa-trash"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="bg"></div>
<div class="popupWrapper" id="addAdmin">
    <div class="popup">
        <div class="wrap">
            <h3>Tambah Admin
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#addAdmin')"></i>
            </h3>
            <form action="{{ route('admin.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="mt-2">Nama :</div>
                <input type="text" class="box" name="name" required>
                <div class="mt-2">Email :</div>
                <input type="email" class="box" name="email" required>
                <div class="mt-2">Password :</div>
                <input type="password" class="box" name="password" required>

                <button class="lebar-100 mt-3 hijau">Tambahkan</button>
            </form>
        </div>
    </div>
</div>

<div class="popupWrapper" id="editAdmin">
    <div class="popup">
        <div class="wrap">
            <h3>Edit Data
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#editAdmin')"></i>
            </h3>
            <form action="{{ route('admin.update') }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="id" id="id">
                <div class="mt-2">Nama :</div>
                <input type="text" class="box" name="name" id="name" required>
                <div class="mt-2">Email :</div>
                <input type="email" class="box" name="email" id="email" required>
                <div class="mt-2">Ganti Password :</div>
                <input type="password" class="box" name="password" id="password" placeholder="Biarkan kosong jika tidak ingin mengganti password">

                <button class="lebar-100 mt-3 hijau">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    const edit = data => {
        data = JSON.parse(data);
        munculPopup("#editAdmin");

        select("#editAdmin #id").value = data.id;
        select("#editAdmin #name").value = data.name;
        select("#editAdmin #email").value = data.email;
    }
</script>
@endsection