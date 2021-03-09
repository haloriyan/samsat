<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('app.index');
});

Route::get('admin', function () {
    return redirect()->route('admin.loginPage');
});

Route::group(['prefix' => "app"], function() {
    Route::get('login', "CompanyController@loginPage")->name('app.loginPage');
    Route::post('login', "CompanyController@login")->name('app.login');
    Route::get('register', "CompanyController@registerPage")->name('app.registerPage');
    Route::post('register', "CompanyController@register")->name('app.register');
    Route::get('logout', "CompanyController@logout")->name('app.logout');
    
    Route::get('/', "CompanyController@index")->name('app.index')->middleware('Company');
    Route::get('profile', "CompanyController@profile")->name('app.profile');
    Route::post('profile/update', "CompanyController@updateProfile")->name('app.updateProfile');
    Route::get('notification', "CompanyController@notification")->name('app.notification');
    Route::get('pkb-tahunan', "CompanyController@formPkbTahunan")->name('app.pkbTahunan')->middleware('Company');
    Route::post('pkb-tahunan/store', "PkbController@store")->name('app.pkbTahunan.store')->middleware('Company');

    Route::get('rju', "CompanyController@formRju")->name('app.rju')->middleware('Company');
    Route::post('rju/store', "RjuController@store")->name('app.rju.store')->middleware('Company');

    Route::get('pap', "CompanyController@formPap")->name('app.pap')->middleware('Company');
    Route::post('pap/store', "PapController@store")->name('app.pap.store')->middleware('Company');

    Route::get('pbbkb', "CompanyController@formPbbkb")->name('app.pbbkb')->middleware('Company');
    Route::post('pbbkb/store', "PbbkbController@store")->name('app.pbbkb.store')->middleware('Company');

    Route::get('kendaraan', "CompanyController@formKendaraan")->name('app.kendaraan')->middleware('Company');
    Route::post('kendaraan/store', "KendaraanController@store")->name('app.kendaraan.store')->middleware('Company');
    
    Route::get('kendaraan-status', "CompanyController@formKendaraanStatus")->name('app.kendaraanStatus')->middleware('Company');
    Route::post('kendaraan-status/store', "KendaraanStatusController@store")->name('app.kendaraanStatus.store')->middleware('Company');

    Route::get('layanan-unggulan', "CompanyController@layananUnggulan")->name('app.layananUnggulan')->middleware('Company');
    Route::get('layanan-unggulan/{id}/detail', "LayananController@detail")->name('app.layananUnggulan.detail')->middleware('Company');
});

Route::group(['prefix' => "admin"], function() {
    Route::get('login', "AdminController@loginPage")->name('admin.loginPage');
    Route::post('login', "AdminController@login")->name('admin.login');
    Route::get('logout', "AdminController@logout")->name('admin.logout');

    Route::get('dashboard', "AdminController@dashboard")->name('admin.dashboard')->middleware('Admin');
    Route::get('companies', "AdminController@companies")->name('admin.companies')->middleware('Admin');
    Route::get('pkb', "AdminController@pkb")->name('admin.pkb')->middleware('Admin');
    Route::get('rju', "AdminController@rju")->name('admin.rju')->middleware('Admin');
    Route::get('pap', "AdminController@pap")->name('admin.pap')->middleware('Admin');
    Route::get('pap/{id}/{status}', "PapController@action")->name('admin.pap.action')->middleware('Admin');
    Route::get('pbbkb', "AdminController@pbbkb")->name('admin.pbbkb')->middleware('Admin');
    Route::get('pbbkb/{id}/{status}', "PbbkbController@action")->name('admin.pbbkb.action')->middleware('Admin');
    Route::get('kendaraan', "AdminController@kendaraan")->name('admin.kendaraan')->middleware('Admin');
    Route::get('kendaraan-status', "AdminController@kendaraanStatus")->name('admin.kendaraanStatus')->middleware('Admin');

    Route::get('layanan-unggulan', "AdminController@layananUnggulan")->name('admin.layananUnggulan')->middleware('Admin');
    Route::post('layanan-unggulan/store', "LayananController@store")->name('admin.layananUnggulan.store')->middleware('Admin');
    Route::post('layanan-unggulan/update', "LayananController@update")->name('admin.layananUnggulan.update')->middleware('Admin');
});
