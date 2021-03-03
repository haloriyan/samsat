<?php

namespace App\Http\Controllers;

use App\Models\Pkb;
use Illuminate\Http\Request;

class PkbController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Pkb;
        }
        return Pkb::where($filter);
    }
    public function store(Request $req) {
        $myData = CompanyController::me();

        $nopols = implode(",", $req->nopol);

        $saveData = Pkb::create([
            'company_id' => $myData->id,
            'nopol' => $nopols,
            'payment_date' => $req->payment_date
        ]);

        return redirect()->route('app.index')->with([
            'message' => "Data untuk Pengajuan Layanan Pembayaran Kendaraan Bermotor Tahunan berhasil dikirimkan"
        ]);
    }
}
