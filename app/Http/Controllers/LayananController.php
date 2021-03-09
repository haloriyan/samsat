<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Layanan;
        }
        return Layanan::where($filter);
    }
    public function store(Request $req) {
        $days = $req->days;
        $times = $req->times;

        foreach ($days as $i => $day) {
            if ($day != "") {
                $jadwal[] = [$day, $times[$i]];
            }
        }
        $jadwal = json_encode($jadwal);

        $photo = $req->file('foto');
        $photoFileName = $photo->getClientOriginalName();

        $saveData = Layanan::create([
            'category' => $req->category,
            'nama' => $req->nama,
            'alamat' => $req->alamat,
            'foto' => $photoFileName,
            'phone' => $req->phone,
            'google_maps' => $req->google_maps,
            'jadwal' => $jadwal,
        ]);
        $photo->storeAs('public/foto_layanan_unggulan', $photoFileName);

        return redirect()->route('admin.layananUnggulan')->with([
            'message' => "Data Layanan Unggulan berhasil ditambahkan"
        ]);
    }
    public function update(Request $req) {
        $id = $req->data_id;
        $data = Layanan::where('id', $id);
        $layanan = $data->first();

        $days = $req->days;
        $times = $req->times;

        foreach ($days as $i => $day) {
            if ($day != "") {
                $jadwal[] = [$day, $times[$i]];
            }
        }
        $jadwal = json_encode($jadwal);

        $toUpdate = [
            'category' => $req->category,
            'nama' => $req->nama,
            'alamat' => $req->alamat,
            'phone' => $req->phone,
            'google_maps' => $req->google_maps,
            'jadwal' => $jadwal,
        ];

        $photo = $req->file('foto');
        if ($photo) {
            $photoFileName = $photo->getClientOriginalName();
            $toUpdate['foto'] = $photoFileName;
            $deleteOldPhoto = Storage::delete('public/foto_layanan_unggulan'.$layanan->foto);
            $photo->storeAs('public/foto_layanan_unggulan/', $photoFileName);
        }

        $updateData = $data->update($toUpdate);

        return redirect()->route('admin.layananUnggulan')->with([
            'message' => "Data Layanan Unggulan berhasil ditambahkan"
        ]);
    }
    public function detail($id) {
        $layanan = Layanan::find($id);

        return view('company.detailLayanan', [
            'layanan' => $layanan
        ]);
    }
}
