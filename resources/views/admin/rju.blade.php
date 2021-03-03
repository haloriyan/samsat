@extends('layouts.admin')

@section('title', "Retribusi Jasa Usaha")

@php
    use Carbon\Carbon;
@endphp

@section('content')
@if ($company != null)
    <h3 class="mb-4">
        Menampilkan data dari perusahaan <b>{{ $company->name }}</b>.
        <a href="{{ route('admin.rju') }}" class="teks-biru">hilangkan filter</a>
    </h3>
@endif

<table>
    <thead>
        <tr>
            <th>Perusahaan</th>
            <th>Nama Penanggung Jawab</th>
            <th>Alamat</th>
            <th>NPWP Penanggung Jawab</th>
            <th>No. WhatsApp</th>
            <th>Dibuat pada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->company->name }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->address }}</td>
                <td>{{ $data->npwp }}</td>
                <td>{{ $data->phone }}</td>
                <td>
                    {{ Carbon::parse($data->created_at)->format('d M Y H:i:s') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection