<?php

namespace App\Http\Controllers;

use App\Models\Pap;
use App\Models\Notification;
use Illuminate\Http\Request;

class PapController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Pap;
        }
        return Pap::where($filter);
    }
    public function store(Request $req) {
        $myData = CompanyController::me();

        // check if data is exists
        $data = Pap::where('company_id', $myData->id);
        
        if ($data->get()->count() == 0) {
            $saveData = Pap::create([
                'company_id' => $myData->id,
                'status' => 2
            ]);
        }else {
            $data->update(['status' => 2]);
        }

        return redirect()->route('app.index')->with([
            'message' => "Data permohonan menjadi wajib pajak air permukaan berhasil dikirimkan"
        ]);
    }
    public function action($id, $status) {
        $data = Pap::where('id', $id);
        $updateData = $data->update(['status' => $status]);
        $pap = $data->first();

        if ($status == 1) {
            $body = "Permohonan menjadi Wajib Pajak Air Permukaan Anda diterima";
            $routeAction = "";
        }else {
            $body = "Maaf, permohonan menjadi Wajib Pajak Air Permukaan Anda ditolak. Klik untuk mengirimkan permohonan kembali";
            $routeAction = "app.pap";
        }

        $sendNotification = Notification::create([
            'company_id' => $pap->company_id,
            'body' => $body,
            'route_action' => $routeAction,
            'has_read' => 0
        ]);

        return redirect()->route('admin.pap');
    }
}
