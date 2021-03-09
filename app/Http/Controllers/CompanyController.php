<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\Company;
use App\Models\Notification;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public static function me() {
        return Auth::guard('company')->user();
    }
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Company;
        }
        return Company::where($filter);
    }
    public function processName($name) {
        $name = explode(" ", $name);
        return [$name[0], $name[count($name) - 1]];
    }
    public function loginPage() {
        $message = Session::get('message');

        return view('company.login', [
            'message' => $message
        ]);
    }
    public function login(Request $req) {
        $loggingIn = Auth::guard('company')->attempt([
            'email' => $req->email,
            'password' => $req->password,
        ]);

        if (!$loggingIn) {
            return redirect()->route('app.loginPage')->withErrors(['Email atau Password tidak cocok']);
        }

        return redirect()->route('app.index');
    }
    public function registerPage() {
        $message = Session::get('message');
        
        return view('company.register', [
            'message' => $message
        ]);
    }
    public function register(Request $req) {
        $saveData = Company::create([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'password' => bcrypt($req->password),
            'address' => $req->address,
            'npwp' => $req->npwp,
            'is_active' => 1
        ]);

        return redirect()->route('app.loginPage')->with([
            'message' => "Pendaftaran berhasil. Silahkan login"
        ]);
    }
    public function logout() {
        $loggingOut = Auth::guard('company')->logout();

        return redirect()->route('app.loginPage')->with([
            'message' => "Berhasil logout"
        ]);
    }
    public function index() {
        $myData = self::me();
        $myData->first_name = $this->processName($myData->name)[0];
        
        $message = Session::get('message');

        $notifications = Notification::where([
            ['company_id', $myData->id],
            ['has_read', 0]
        ])->get('id');

        return view('company.index', [
            'myData' => $myData,
            'notifications' => $notifications,
            'message' => $message
        ]);
    }
    public function getInitial($firstName, $lastName) {
        return $firstName[0].$lastName[0];
    }
    public function profile() {
        $myData = self::me();
        $message = Session::get('message');

        $name = $this->processName($myData->name);
        $firstName = $name[0];
        $lastName = $name[1];
        $myData->initial = $this->getInitial($firstName, $lastName);

        return view('company.profile', [
            'myData' => $myData,
            'message' => $message
        ]);
    }
    public function updateProfile(Request $req) {
        $myData = self::me();

        $updateData = Company::where('id', $myData->id)->update([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'address' => $req->address,
            'npwp' => $req->npwp,
        ]);

        return redirect()->route('app.profile')->with([
            'message' => "Profil berhasil diubah"
        ]);
    }
    public function formPkbTahunan() {
        $myData = self::me();

        return view('company.pkbTahunan', [
            'myData' => $myData
        ]);
    }
    public function formRju() {
        $myData = self::me();

        return view('company.rju', [
            'myData' => $myData
        ]);
    }
    public function formPap() {
        $myData = self::me();

        $datas = PapController::get([
            ['company_id', $myData->id],
            ['status', 1]
        ])
        ->orWhere([
            ['company_id', $myData->id],
            ['status', 2]
        ])
        ->get();

        return view('company.pap', [
            'myData' => $myData,
            'datas' => $datas
        ]);
    }
    public function formPbbkb() {
        $myData = self::me();

        $datas = PbbkbController::get([
            ['company_id', $myData->id],
            ['status', 1]
        ])
        ->orWhere([
            ['company_id', $myData->id],
            ['status', 2]
        ])
        ->get();

        return view('company.pbbkb', [
            'myData' => $myData,
            'datas' => $datas
        ]);
    }
    public function notification() {
        $myData = self::me();
        $notifications = Notification::where('company_id', $myData->id)->orderBy('created_at', 'DESC')->paginate(10);

        return view('company.notification', [
            'myData' => $myData,
            'notifications' => $notifications
        ]);
    }
    public function readNotification(Request $req) {
        $companyID = $req->company_id;

        $readAll = Notification::where('company_id', $companyID)->update([
            'has_read' => 1
        ]);

        return response()->json(['status' => 200]);
    }
    public function formKendaraan() {
        return view('company.kendaraan');
    }
    public function formKendaraanStatus() {
        return view('company.kendaraanStatus');
    }
    public function layananUnggulan(Request $req) {
        $queryFilter = [];
        if ($req->category != "") {
            $queryFilter[] = ["category", "LIKE", "%".$req->category."%"];
        }
        $datas = LayananController::get($queryFilter)->get();

        return view('company.layananUnggulan', [
            'datas' => $datas,
            'req' => $req
        ]);
    }
}
