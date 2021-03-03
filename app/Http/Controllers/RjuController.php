<?php

namespace App\Http\Controllers;

use App\Models\Rju;
use Illuminate\Http\Request;

class RjuController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Rju;
        }
        return Rju::where($filter);
    }
    public function store(Request $req) {
        $myData = CompanyController::me();

        $saveData = Rju::create([
            'company_id' => $myData->id,
            'name' => $req->name,
            'address' => $req->address,
            'npwp' => $req->npwp,
            'phone' => $req->phone,
            'status' => 2
        ]);

        return redirect()->route('app.index')->with([
            'message' => "Data permohonan menjadi wajib retribusi telah berhasil dikirimkan"
        ]);
    }
}
