<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use App\Models\KendaraanStatus;

class KendaraanStatusController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new KendaraanStatus;
        }
        return KendaraanStatus::where($filter);
    }
    public function store(Request $req) {
        $status = $req->status;
        $myData = CompanyController::me();

        if ($status == "Jual" || $status == "Dimiliki") {
            $keterangan = $req->keterangan;
        } else {
            $img = $req->keterangan;
            $img = str_replace("data:image/png;base64,", "", $img);
            $img = str_replace(" ", "+", $img);
            $data = base64_decode($img);
            $keterangan = time()."_".rand(1, 99999).".png";
            $store = Storage::put("public/keterangan_status/".$keterangan, $data);
        }

        $saveData = KendaraanStatus::create([
            'company_id' => $myData->id,
            'nopol' => $req->nopol,
            'status' => $req->status,
            'keterangan' => $keterangan,
        ]);

        return redirect()->route('app.index')->with([
            'message' => "Status kendaraan berhasil dilaporkan"
        ]);
    }
}
