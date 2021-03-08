@extends('layouts.admin')

@section('title', "Perusahaan Terdaftar")

@section('head.dependencies')
<style>
    .datas .item .icon {
        font-size: 30px;
    }
</style>
@endsection

@section('content')
<table>
    <thead>
        <tr>
            <th>Nama Perusahaan</th>
            <th>No. WhatsApp</th>
            <th>Alamat</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($companies as $company)
            <tr>
                <td>{{ $company->name }}</td>
                <td>{{ $company->phone }}</td>
                <td>{{ $company->address }}</td>
                <td>
                    <span class="bg-biru rounded p-1 pl-2 pr-2 pointer" onclick="checkData('{{ $company->name }}')">
                        Lihat Data
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="bg"></div>
<div class="popupWrapper" id="checkData">
    <div class="popup">
        <div class="wrap">
            <h3>Lihat Data
                <i class="fas fa-times ke-kanan pointer" onclick="hilangPopup('#checkData')"></i>
            </h3>
            <div class="bagi bagi-3 datas">
                <div class="wrap">
                    <div class="bg-biru item rounded smallPadding rata-tengah pointer" onclick="see('pkb')">
                        <div class="wrap super">
                            <div class="icon"><i class="fas fa-calendar"></i></div>
                            <div class="mt-2">Pembayaran PKB Tahunan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bagi bagi-3 datas">
                <div class="wrap">
                    <div class="bg-biru item rounded smallPadding rata-tengah pointer" onclick="see('rju')">
                        <div class="wrap super">
                            <div class="icon"><i class="fas fa-tags"></i></div>
                            <div class="mt-2">Retribusi Jasa Usaha</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bagi bagi-3 datas">
                <div class="wrap">
                    <div class="bg-biru item rounded smallPadding rata-tengah" onclick="see('pap')">
                        <div class="wrap super">
                            <div class="icon"><i class="fas fa-water"></i></div>
                            <div class="mt-2">Pajak Air Permukaan</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bagi bagi-3 datas">
                <div class="wrap">
                    <div class="bg-biru item rounded smallPadding rata-tengah" onclick="see('pbb')">
                        <div class="wrap super">
                            <div class="icon"><i class="fas fa-water"></i></div>
                            <div class="mt-2">Pajak Bahan Bakar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    let companyName = null;

    const checkData = name => {
        companyName = name;
        munculPopup("#checkData");
    }

    const see = what => {
        console.log(what);
        let redirectTo = "";
        if (what == "pkb") {
            redirectTo = "{{ route('admin.pkb') }}";
        }else if (what == "rju") {
            redirectTo = "{{ route('admin.rju') }}";
        }else if (what == "pap") {
            redirectTo = "{{ route('admin.pap') }}";
        }else if (what == "pbb") {
            redirectTo = "{{ route('admin.pbbkb') }}"
        }
        redirectTo += "?company=" + companyName;
        window.location = redirectTo;
    }
</script>
@endsection