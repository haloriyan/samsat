<?php

namespace App\Http\Controllers;

use App\Models\Pbbkb;
use App\Models\Notification;
use Illuminate\Http\Request;

class PbbkbController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Pbbkb;
        }
        return Pbbkb::where($filter);
    }
    public function store(Request $req) {
        $myData = CompanyController::me();

        $data = Pbbkb::where('company_id', $myData->id);

        if ($data->get()->count() == 0) {
            $saveData = Pbbkb::create([
                'company_id' => $myData->id,
                'status' => 2
            ]);
        }else {
            $data->update(['status' => 2]);
        }

        return redirect()->route('app.index')->with([
            'message' => "Data permohonan menjadi wajib pajak bahan bakar kendaraan bermotor berhasil dikirimkan"
        ]);
    }
    public function action($id, $status) {
        $data = Pbbkb::where('id', $id);
        $updateData = $data->update(['status' => $status]);
        $pbbkb = $data->first();

        if ($status == 1) {
            $body = "Permohonan menjadi Wajib Pajak Bahan Bakar Kendaraan Bermotor Anda diterima";
            $routeAction = "";
        }else {
            $body = "Maaf, permohonan menjadi Wajib Pajak Bahan Bakar Kendaraan Bermotor Anda ditolak. Klik untuk mengirimkan permohonan kembali";
            $routeAction = "app.pbbkb";
        }

        $sendNotification = Notification::create([
            'company_id' => $pbbkb->company_id,
            'body' => $body,
            'route_action' => $routeAction,
            'has_read' => 0
        ]);

        return redirect()->route('admin.pbbkb');
    }
}
