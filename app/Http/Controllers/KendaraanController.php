<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Kendaraan;
        }
        return Kendaraan::where($filter);
    }
    public function store(Request $req) {
        $myData = CompanyController::me();

        $saveData = Kendaraan::create([
            'company_id' => $myData->id,
            'nopol' => $req->nopol,
            'nomor_rangka' => $req->nomor_rangka,
        ]);

        return redirect()->route('app.index')->with([
            'message' => "Data kendaraan berhasil dikirimkan"
        ]);
    }
}
