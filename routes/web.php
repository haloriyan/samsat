<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "UserController@index")->name("page.index");

Route::get('admin', function () {
    return redirect()->route('admin.loginPage');
});

Route::group(['prefix' => "app"], function() {
    Route::get('login', "CompanyController@loginPage")->name('app.loginPage');
    Route::post('login', "CompanyController@login")->name('app.login');
    Route::get('register', "CompanyController@registerPage")->name('app.registerPage');
    Route::get('register-verification/{sessionID}', "CompanyController@registerVerification")->name('app.registerVerification');
    Route::get('otp-auth/{sessionID}', "CompanyController@otpAuth")->name('app.otpAuth');
    Route::post('otp-auth/{sessionID}', "CompanyController@otpAuthAction")->name('app.otpAuth.action');
    Route::get('resend-token/{sessionID}', "CompanyController@resendToken")->name('app.resendToken');
    Route::get('activate-account/{companyID}', "CompanyController@activateAccount")->name("app.activateAccount");
    Route::post('register', "CompanyController@register")->name('app.register');
    Route::get('logout', "CompanyController@logout")->name('app.logout');
    Route::get('forgot-password', "CompanyController@forgotPassword")->name('app.forgotPassword');
    Route::post('forgot-password/action', "CompanyController@forgotPasswordAction")->name('app.forgotPassword.action');
    Route::get('reset-password/{companyID}', "CompanyController@resetPassword")->name('app.resetPassword');
    Route::post('reset-password/{companyID}/action', "CompanyController@resetPasswordAction")->name('app.resetPassword.action');
    
    Route::get('/', "CompanyController@index")->name('app.index')->middleware('Company');
    Route::get('profile', "CompanyController@profile")->name('app.profile')->middleware('Company');
    Route::post('profile/update', "CompanyController@updateProfile")->name('app.updateProfile')->middleware('Company');
    Route::get('notification', "CompanyController@notification")->name('app.notification')->middleware('Company');
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

    Route::get('payment', "CompanyController@payment")->name('app.payment')->middleware('Company');
    Route::get('payment/{id}', "CompanyController@payment")->name('app.payment.detail')->middleware('Company');
});

Route::group(['prefix' => "admin"], function() {
    Route::get('login', "AdminController@loginPage")->name('admin.loginPage');
    Route::post('login', "AdminController@login")->name('admin.login');
    Route::get('logout', "AdminController@logout")->name('admin.logout');

    Route::get('dashboard', "AdminController@dashboard")->name('admin.dashboard')->middleware('Admin');
    Route::get('companies', "AdminController@companies")->name('admin.companies')->middleware('Admin');
    Route::get('companies/{id}/delete', "CompanyController@delete")->name('admin.company.delete')->middleware('Admin');
    Route::get('pkb', "AdminController@pkb")->name('admin.pkb')->middleware('Admin');
    Route::get('rju', "AdminController@rju")->name('admin.rju')->middleware('Admin');
    Route::get('pap', "AdminController@pap")->name('admin.pap')->middleware('Admin');
    Route::get('pap/{id}/{status}', "PapController@action")->name('admin.pap.action')->middleware('Admin');
    Route::get('pbbkb', "AdminController@pbbkb")->name('admin.pbbkb')->middleware('Admin');
    Route::get('pbbkb/{id}/{status}', "PbbkbController@action")->name('admin.pbbkb.action')->middleware('Admin');
    Route::get('kendaraan', "AdminController@kendaraan")->name('admin.kendaraan')->middleware('Admin');
    Route::get('kendaraan-status', "AdminController@kendaraanStatus")->name('admin.kendaraanStatus')->middleware('Admin');
    Route::get('admin', "AdminController@admin")->name('admin.admin')->middleware('Admin');
    Route::post('admin/update', "AdminController@update")->name('admin.update')->middleware('Admin');
    Route::post('admin/store', "AdminController@store")->name('admin.store')->middleware('Admin');
    Route::get('admin/{id}/delete', "AdminController@delete")->name('admin.delete')->middleware('Admin');

    Route::get('layanan-unggulan', "AdminController@layananUnggulan")->name('admin.layananUnggulan')->middleware('Admin');
    Route::post('layanan-unggulan/store', "LayananController@store")->name('admin.layananUnggulan.store')->middleware('Admin');
    Route::post('layanan-unggulan/update', "LayananController@update")->name('admin.layananUnggulan.update')->middleware('Admin');
    Route::get('layanan-unggulan/{delete}', "LayananController@delete")->name('admin.layananUnggulan.delete')->middleware('Admin');

    Route::group(['prefix' => "payment"], function () {
        Route::post('store', "PaymentController@store")->name('admin.payment.store')->middleware('Admin');
        Route::post('update', "PaymentController@update")->name('admin.payment.update')->middleware('Admin');
        Route::post('delete', "PaymentController@delete")->name('admin.payment.delete')->middleware('Admin');
        Route::get('/', "AdminController@payment")->name('admin.payment')->middleware('Admin');
    });
});
