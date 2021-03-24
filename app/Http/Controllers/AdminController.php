<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
    }
    public static function me() {
        return Auth::guard('admin')->user();
    }
    public function loginPage() {
        $message = Session::get('message');

        return view('admin.login', [
            'message' => $message
        ]);
    }
    public function login(Request $req) {
        $loggingIn = Auth::guard('admin')->attempt([
            'email' => $req->email,
            'password' => $req->password,
        ]);

        if (!$loggingIn) {
            return redirect()->route('admin.loginPage')->withErrors(['Email atau Password tidak cocok']);
        }

        return redirect()->route('admin.dashboard');
    }
    public function logout() {
        $loggingOut = Auth::guard('admin')->logout();

        return redirect()->route('admin.loginPage')->with([
            'message' => "Berhasil logout"
        ]);
    }
    public function dashboard() {
        $companies = CompanyController::get()->get('id');
        $kendaraan = KendaraanController::get()->get('id');
        $layanan = LayananController::get()->get('id');
        $pkb = PkbController::get()->orderBy('created_at', 'DESC')->paginate(5);
        $statusKendaraan = KendaraanStatusController::get()->orderBy('created_at', 'DESC')->paginate(5);
        
        return view('admin.dashboard', [
            'companies' => $companies,
            'layanan' => $layanan,
            'pkb' => $pkb,
            'statusKendaraan' => $statusKendaraan,
            'kendaraan' => $kendaraan
        ]);
    }
    public function admin(Request $req) {
        $data = new Admin;
        if ($req->q != "") {
            $admins = $data->where('name', 'LIKE', '%'.$req->q.'%')->get();
        }else {
            $admins = $data->get();
        }
        $myData = self::me();
        $message = Session::get('message');

        return view('admin.admin', [
            'admins' => $admins,
            'req' => $req,
            'message' => $message,
            'myData' => $myData
        ]);
    }
    public function store(Request $req) {
        $saveData = Admin::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => bcrypt($req->password),
            'role' => 'super',
        ]);

        return redirect()->route('admin.admin')->with([
            'message' => "Admin baru berhasil ditambahkan"
        ]);
    }
    public function update(Request $req) {
        $id = $req->id;

        $toUpdate = [
            'name' => $req->name,
            'email' => $req->email,
        ];

        if ($req->password != "") {
            $toUpdate['password'] = bcrypt($req->password);
        }

        $updateData = Admin::where('id', $id)->update($toUpdate);

        return redirect()->route('admin.admin')->with([
            'message' => "Data admin berhasil diubah"
        ]);
    }
    public function companies() {
        $companies = CompanyController::get()->get();

        return view('admin.companies', [
            'companies' => $companies
        ]);
    }
    public function generateFileName($context, $startDate = NULL, $endDate = NULL) {
        $ret = $context."_";
        if ($startDate || $endDate) {
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate);
            $ret .= $startDate->isoFormat('D_MMMM_Y')."-".$endDate->isoFormat('D_MMMM_Y');
        }
        $ret .= "_exported_at_".date('Ymd');
        return $ret.".csv";
    }
    public function pkb(Request $req) {
        global $companySearch;
        $companyID = $req->company_id;
        
        $company = null;
        $queryFilter = null;
        if ($companyID) {
            $company = CompanyController::get([
                ['id', '=', $companyID]
            ])->first();
        }

        $datas = PkbController::get($queryFilter);

        if ($req->start_date != "") {
            $startDate = $req->start_date;
            $endDate = $req->end_date;
            $datas = $datas->whereBetween('payment_date', [$startDate, $endDate]);
        }

        if ($req->company != "") {
            $companySearch = $req->company;
            $datas = $datas->whereHas('company', function($query) {
                global $companySearch;
                $query->where('name', 'like', '%'.$companySearch.'%');
            });
        }

        $datas = $datas->orderBy('created_at', 'DESC')
        ->with('company');

        $datasToExport = [];
        $i = 1;
        foreach ($datas->get() as $data) {
            $datasToExport[] = [
                "No" => $i++,
                "Nama Perusahaan" => $data->company->name,
                "Alamat Perusahaan" => $data->company->address,
                "No. Telepon / WhatsApp Perusahaan" => $data->company->phone,
                "Nomor Polisi" => $data->nopol,
                "Tanggal Pembayaran" => Carbon::parse($data->payment_date)->isoFormat('d MMMM Y')
            ];
        }

        $datas = $datas->paginate(50);

        return view('admin.pkb', [
            'datas' => $datas,
            'datasToExport' => $datasToExport,
            'req' => $req,
            'generatedFileName' => $this->generateFileName("PKB_Tahunan", $req->start_date, $req->end_date),
            'company' => $company
        ]);
    }
    public function rju(Request $req) {
        global $companySearch;
        $companySearch = $req->company;
        $company = null;
        $queryFilter = null;

        $datas = RjuController::get($queryFilter);

        if ($companySearch) {
            $company = CompanyController::get([
                ['name', 'LIKE', '%'.$companySearch.'%']
            ])->first();

            $datas = $datas->whereHas('company', function($query) {
                global $companySearch;
                $query->where('name', 'LIKE', "%".$companySearch."%");
            });
        }

        $datas = $datas->with('company')
        ->orderBy('created_at', 'DESC');

        $datasToExport = [];
        $i = 1;
        foreach ($datas->get() as $data) {
            $datasToExport[] = [
                "No" => $i++,
                "Nama Perusahaan" => $data->company->name,
                "Alamat Perusahaan" => $data->company->address,
                "No. Telepon / WhatsApp Perusahaan" => $data->company->phone,
                "Nama Penanggung Jawab" => $data->name,
                "Alamat Penanggung Jawab" => $data->address,
                "NPWP Penanggung Jawab" => $data->npwp,
                "No. Telepon Penanggung Jawab" => $data->phone
            ];
        }

        if ($req->start_date != "") {
            $startDate = $req->start_date;
            $endDate = $req->end_date;
            $datas = $datas->whereBetween('created_at', [$startDate, $endDate]);
        }

        $datas = $datas->paginate(50);

        return view('admin.rju', [
            'datas' => $datas,
            'datasToExport' => $datasToExport,
            'req' => $req,
            'generatedFileName' => $this->generateFileName("Permohonan_Wajib_RJU", $req->start_date, $req->end_date),
            'company' => $company
        ]);
    }
    public function pap(Request $req) {
        $queryFilter = null;
        global $company;

        if ($req->status != "") {
            $queryFilter[] = ["status", $req->status];
        }
        $datas = PapController::get($queryFilter);

        if ($req->company != "") {
            $company = $req->company;
            $datas = $datas->whereHas('company', function(Builder $query) {
                global $company;
                $query->where('name', 'LIKE', '%'.$company.'%');
            });
        }else {
            $datas = $datas->with('company');
        }

        $datas = $datas->orderBy('created_at', 'DESC')
        ->get();

        return view('admin.pap', [
            'datas' => $datas,
            'req' => $req
        ]);
    }
    public function pbbkb(Request $req) {
        $queryFilter = null;
        global $company;

        if ($req->status != "") {
            $queryFilter[] = ["status", $req->status];
        }
        $datas = PbbkbController::get($queryFilter);

        if ($req->company != "") {
            $company = $req->company;
            $datas = $datas->whereHas('company', function(Builder $query) {
                global $company;
                $query->where('name', 'LIKE', '%'.$company.'%');
            });
        }else {
            $datas = $datas->with('company');
        }

        $datas = $datas->orderBy('created_at', 'DESC')->get();

        return view('admin.pbbkb', [
            'req' => $req,
            'datas' => $datas
        ]);
    }
    public function kendaraan(Request $req) {
        $datas = KendaraanController::get();

        if ($req->company != "") {
            global $companySearch;
            $companySearch = $req->company;
            $datas = $datas->whereHas('company', function($query) {
                global $companySearch;
                $query->where('name', 'LIKE', '%'.$companySearch.'%');
            });
        }

        $datas = $datas->with('company');

        $datasToExport = [];
        $i = 1;
        foreach ($datas->get() as $data) {
            $datasToExport[] = [
                "No" => $i++,
                "Nama Perusahaan" => $data->company->name,
                "Alamat Perusahaan" => $data->company->address,
                "No. Telepon / WhatsApp Perusahaan" => $data->company->phone,
                "Nomor Polisi" => $data->nopol,
                "Nomor Rangka" => $data->nomor_rangka
            ];
        }

        $datas = $req->company != "" ? $datas->get() : $datas->paginate(50);
        $generatedFileName = $this->generateFileName("Data_Kendaraan_Bermotor_Perusahaan");

        return view('admin.kendaraan', [
            'datas' => $datas,
            'datasToExport' => $datasToExport,
            'generatedFileName' => $generatedFileName,
            'req' => $req
        ]);
    }
    public function kendaraanStatus(Request $req) {
        $datas = KendaraanStatusController::get();

        if ($req->company != "") {
            global $companySearch;
            $companySearch = $req->company;
            $datas = $datas->whereHas('company', function($query) {
                global $companySearch;
                $query->where('name', 'LIKE', '%'.$companySearch.'%');
            });
        }
        $datas = $datas->with('company');

        $datasToExport = [];
        $i = 1;
        foreach ($datas->get() as $data) {
            $keterangan = $data->status != "Jual" ? $keterangan = asset("storage/keterangan_status/".$data->keterangan) : $data->keterangan;
            $datasToExport[] = [
                "No" => $i++,
                "Nama Perusahaan" => $data->company->name,
                "Alamat Perusahaan" => $data->company->address,
                "No. Telepon / WhatsApp Perusahaan" => $data->company->phone,
                "Nomor Polisi" => $data->nopol,
                "Status" => $data->status,
                "Keterangan" => $keterangan
            ];
        }

        $generatedFileName = $this->generateFileName("Laporan_Status_Kendaraan");
        $datas = $req->company != "" ? $datas->get() : $datas->paginate(50);

        return view('admin.kendaraanStatus', [
            'datas' => $datas,
            'datasToExport' => $datasToExport,
            'generatedFileName' => $generatedFileName,
            'req' => $req,
        ]);
    }
    public function layananUnggulan(Request $req) {
        $queryFilter = [];
        if ($req->q != "") {
            $queryFilter[] = ["nama", "LIKE", "%".$req->q."%"];
        }
        $datas = LayananController::get($queryFilter)->get();

        return view('admin.layananUnggulan', [
            'datas' => $datas,
            'req' => $req
        ]);
    }
}
