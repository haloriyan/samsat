<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
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
        return view('admin.dashboard');
    }
    public function companies() {
        $companies = CompanyController::get()->get();

        return view('admin.companies', [
            'companies' => $companies
        ]);
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
            $queryFilter = [
                ['company_id', $companyID]
            ];
        }

        $datas = PkbController::get($queryFilter);

        if ($req->company != "") {
            $companySearch = $req->company;
            $datas = $datas->whereHas('company', function($query) {
                global $companySearch;
                $query->where('name', 'like', '%'.$companySearch.'%');
            });
        }

        $datas = $datas->orderBy('created_at', 'DESC')
        ->with('company')
        ->get();

        return view('admin.pkb', [
            'datas' => $datas,
            'req' => $req,
            'company' => $company
        ]);
    }
    public function rju(Request $req) {
        $companyID = $req->company_id;
        $company = null;
        $queryFilter = null;

        if ($companyID) {
            $company = CompanyController::get([
                ['id', '=', $companyID]
            ])->first();
            $queryFilter = [
                ['company_id', $companyID]
            ];
        }

        $datas = RjuController::get($queryFilter)
        ->with('company')
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('admin.rju', [
            'datas' => $datas,
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
}
