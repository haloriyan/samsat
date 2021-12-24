<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Payment;
        }
        return Payment::where($filter);
    }
    public function store(Request $request) {
        $image = $request->file('image');
        $imageFileName = $image->getClientOriginalName();

        $saveData = Payment::create([
            'title' => $request->title,
            'link' => $request->link,
            'image' => $imageFileName,
            'instruction' => $request->instruction,
        ]);

        $image->storeAs('public/payment_image', $imageFileName);

        return redirect()->route('admin.payment')->with(['message' => "Data informasi berhasil ditambahkan"]);
    }
    public function update(Request $request) {
        $id = $request->id;
        $data = Payment::where('id', $id);
        $payment = $data->first();

        $toUpdate = [
            'title' => $request->title,
            'link' => $request->link,
            'instruction' => $request->instruction,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFileName = $image->getClientOriginalName();
            $toUpdate['image'] = $imageFileName;
            $deleteOldImage = Storage::delete('public/payment_image/'.$payment->image);
            $image->storeAs('public/payment_image', $imageFileName);
        }

        $updateData = $data->update($toUpdate);
        
        return redirect()->route('admin.payment')->with(['message' => "Informasi pembayaran ".$payment->title." berhasil diubah"]);
    }
    public function delete(Request $request) {
        $id = $request->id;
        $data = Payment::where('id', $id);
        $payment = $data->first();
        $deleteData = $data->delete();

        return redirect()->route('admin.payment')->with(['message' => "Informasi pembayaran ".$payment->title." berhasil dihapus"]);
    }
}
