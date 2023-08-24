<?php

use App\Http\Controllers\ViewDPAController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\PembantuPPTKUploadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Imports\ArsipLamaImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\RekananController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

//arsip
Route::get('/imported-data', [ImportController::class, 'showImportedData'])->name('imported.data');
Route::resource('/arsip', App\Http\Controllers\ArsipController::class);
Route::get('/Dokumen', [ArsipController::class, 'index'])->name('Arsip.index');
Route::get('/Dokumen/Import-file', [ArsipController::class, 'importfile'])->name('Arsip.importfile');
Route::post('/Dokumen/Import', [ArsipController::class, 'import'])->name('Arsip.import');
Route::get('/Dokumen/{id}/Edit', [ArsipController::class, 'edit'])->name('Arsip.edit');
Route::put('/Dokumen/{id}', [ArsipController::class, 'update'])->name('Arsip.update');
Route::get('/Dokumen/Create', [ArsipController::class, 'create'])->name('Arsip.create');
Route::post('/Dokumen/Store', [ArsipController::class, 'store'])->name('Arsip.store');
Route::delete('/Dokumen/{id}', [ArsipController::class, 'destroy'])->name('Arsip.destroy');
// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);
//rekanan
Route::resource('rekanan', RekananController::class);
Route::get('/Rekanan', [RekananController::class, 'index'])->name('rekanan.index');
Route::get('/Rekanan/Create', [RekananController::class, 'create'])->name('rekanan.create');
Route::post('/Rekanan/Store', [RekananController::class, 'store'])->name('rekanan.store');
Route::get('/Rekanan/{id}/Edit', [RekananController::class, 'edit'])->name('rekanan.edit');
Route::put('/Rekanan/{id}', [RekananController::class, 'update'])->name('rekanan.update');

Route::get('/dokumenpembantupptk', [PembantuPPTKUploadController::class, 'dokumenPembantuPPTK'])->name('PembantuPPTKView.dokumenpembantupptk');
    //E-Purchasing
    Route::get('/epurchasing/create', [PembantuPPTKUploadController::class, 'createEPurchasing'])->name('PembantuPPTKView.epurchaseview.create');
    Route::get('/epurchasing', [PembantuPPTKUploadController::class, 'indexEPurchasing'])->name('PembantuPPTKView.epurchaseview.index');
    Route::post('/epurchasing', [PembantuPPTKUploadController::class, 'storeEPurchasing'])->name('PembantuPPTKView.epurchaseview.store');
    Route::get('/epurchasing/{id}/edit', [PembantuPPTKUploadController::class, 'editEPurchasing'])->name('PembantuPPTKView.epurchaseview.edit');
    Route::put('/epurchasing/{id}', [PembantuPPTKUploadController::class, 'updateEPurchasing'])->name('PembantuPPTKView.epurchaseview.update');

    //BAST
    Route::get('/bast/create', [PembantuPPTKUploadController::class, 'createBast'])->name('PembantuPPTKView.bast.create');
    Route::post('/bast/store', [PembantuPPTKUploadController::class, 'storeBast'])->name('PembantuPPTKView.bast.store');
    Route::get('/bast/{id}', [PembantuPPTKUploadController::class, 'indexBast'])->name('PembantuPPTKView.bast.index');
    Route::get('/bast/{id}/edit', [PembantuPPTKUploadController::class, 'editBast'])->name('PembantuPPTKView.bast.edit');
    Route::put('/bast/{id}', [PembantuPPTKUploadController::class, 'updateBast'])->name('PembantuPPTKView.bast.update');
    
    //DokumenKontrak
    Route::get('/PembantuPPTKView/dokumenkontrak/create', [PembantuPPTKUploadController::class, 'createDokumenKontrak'])->name('PembantuPPTKView.dokumenkontrak.create');
    Route::post('/PembantuPPTKView/dokumenkontrak/store', [PembantuPPTKUploadController::class, 'storeDokumenKontrak'])->name('PembantuPPTKView.dokumenkontrak.store');
    Route::get('/PembantuPPTKView/dokumenkontrak/show/{id}', [PembantuPPTKUploadController::class, 'showDokumenKontrak'])->name('PembantuPPTKView.dokumenkontrak.show');
    Route::get('/PembantuPPTKView/dokumenkontrak/{id}/edit', [PembantuPPTKUploadController::class, 'editDokumenKontrak'])->name('PembantuPPTKView.dokumenkontrak.edit');
    Route::put('/PembantuPPTKView/dokumenkontrak/update/{id}', [PembantuPPTKUploadController::class, 'updateDokumenKontrak'])->name('PembantuPPTKView.dokumenkontrak.update');

    //DokumenPendukung
    Route::get('/dokumenpendukung/create', [PembantuPPTKUploadController::class, 'createDokumenPendukung'])->name('PembantuPPTKView.dokumenpendukung.create');
    Route::get('/dokumenpendukung', [PembantuPPTKUploadController::class, 'indexDokumenPendukung'])->name('PembantuPPTKView.dokumenpendukung.index');
    Route::post('/dokumenpendukung', [PembantuPPTKUploadController::class, 'storeDokumenPendukung'])->name('PembantuPPTKView.dokumenpendukung.store');
    Route::get('/dokumenpendukung/{id}/edit', [PembantuPPTKUploadController::class, 'editDokumenPendukung'])->name('PembantuPPTKView.dokumenpendukung.edit');
    Route::put('/dokumenpendukung/{id}', [PembantuPPTKUploadController::class, 'updateDokumenPendukung'])->name('PembantuPPTKView.dokumenpendukung.update');

    //DokumenJustifikasi
    Route::get('/dokumenjustifikasi/create', [PembantuPPTKUploadController::class, 'createDokumenJustifikasi'])->name('PembantuPPTKView.dokumenjustifikasi.create');
    Route::get('/dokumenjustifikasi/index', [PembantuPPTKUploadController::class, 'indexDokumenJustifikasi'])->name('PembantuPPTKView.dokumenjustifikasi.index');
    Route::post('/dokumenjustifikasi/store', [PembantuPPTKUploadController::class, 'storeDokumenJustifikasi'])->name('PembantuPPTKView.dokumenjustifikasi.store');
    Route::get('/dokumenjustifikasi/{id}/edit', [PembantuPPTKUploadController::class, 'editDokumenJustifikasi'])->name('PembantuPPTKView.dokumenjustifikasi.edit');
    Route::put('/dokumenjustifikasi/{id}', [PembantuPPTKUploadController::class, 'updateDokumenJustifikasi'])->name('PembantuPPTKView.dokumenjustifikasi.update');

    //BAP
    Route::get('/bap/create', [PembantuPPTKUploadController::class, 'createBap'])->name('PembantuPPTKView.bap.create');
    Route::post('/bap/store', [PembantuPPTKUploadController::class, 'storeBap'])->name('PembantuPPTKView.bap.store');
    Route::get('/bap/index', [PembantuPPTKUploadController::class, 'indexBap'])->name('PembantuPPTKView.bap.index');
    Route::get('/bap/{id}/edit', [PembantuPPTKUploadController::class, 'editBap'])->name('PembantuPPTKView.bap.edit');
    Route::put('/bap/{id}', [PembantuPPTKUploadController::class, 'updateBap'])->name('PembantuPPTKView.bap.update');
    
    //BAPH
    Route::get('/baph/index', [PembantuPPTKUploadController::class, 'indexBaph'])->name('PembantuPPTKView.baph.index');
    Route::get('/baph/create', [PembantuPPTKUploadController::class, 'createBaph'])->name('PembantuPPTKView.baph.create');
    Route::post('/baph/store', [PembantuPPTKUploadController::class, 'storeBaph'])->name('PembantuPPTKView.baph.store');
    Route::get('/baph/{id}/edit', [PembantuPPTKUploadController::class, 'editBaph'])->name('PembantuPPTKView.baph.edit');
    Route::put('/baph/{id}', [PembantuPPTKUploadController::class, 'updateBaph'])->name('PembantuPPTKView.baph.update');

    //PilihRekanan
    Route::get('/pilihrekanan/create', [PembantuPPTKUploadController::class, 'createPilihRekanan'])->name('PembantuPPTKView.pilihrekanan.create');
    Route::get('/pilihrekanan/index', [PembantuPPTKUploadController::class, 'indexPilihRekanan'])->name('PembantuPPTKView.pilihrekanan.index');
    Route::post('/pilihrekanan/store', [PembantuPPTKUploadController::class, 'storePilihRekanan'])->name('PembantuPPTKView.pilihrekanan.store');
    Route::get('/pilihrekanan/{id}/edit', [PembantuPPTKUploadController::class, 'editPilihRekanan'])->name('PembantuPPTKView.pilihrekanan.edit');
    Route::put('/pilihrekanan/{id}', [PembantuPPTKUploadController::class, 'updatePilihRekanan'])->name('PembantuPPTKView.pilihrekanan.update');

// Upload DPA
Route::resource('UploadDPA', App\Http\Controllers\UploadDPAController::class);
Route::get('/UploadDpa', [UploadDPAController::class, 'index'])->name('UploadDpa.index');
Route::post('/UploadDpa', [UploadDPAController::class, 'store'])->name('UploadDpa.store');
//Route::get('/ViewDpa', [ViewDPAController::class, 'index'])->name('ViewDPA.index');
//Route::get('/', [UploadDPAController::class, 'index'])->name('upload_dpa.index');
//Route::post('/store', [UploadDPAController::class, 'store'])->name('upload_dpa.store');

// View List DPA
Route::resource('ViewDPA', App\Http\Controllers\ViewDPAController::class);
//view sub DPA
Route::get('/ViewDPA/{dpa}', 'ViewDPAController@show')->name('ViewDPA.show');
Route::get('/EditDPA/{id}', [ViewDPAController::class, 'edit'])->name('editDPA');
Route::get('/ViewPDF/{id}', [ViewDPAController::class, 'viewPDF'])->name('viewPDF');
Route::put('/DPA/{dpa}', [ViewDPAController::class, 'update'])->name('updateDPA');
Route::get('/assignPP/{dpaId}/{userId}', [ViewDPAController::class, 'assignPP'])->name('ViewDPA.assignPP');
Route::get('/assignPPPTK/{dpaId}/{userId}', [ViewDPAController::class, 'assignPPPTK'])->name('ViewDPA.assignPPPTK');


// Route to view the uploaded PDF data (ViewDPA site)
//Route::get('/View', [ViewDPAController::class, 'index']);
//dpa and user
Route::get('/ViewDPA/{dpaId}/{userId}', [ViewDPAController::class, 'assignDpa'])->name('ViewDPA.assignDpa');
// Upload berkas Bendahara
Route::resource('bendahara', App\Http\Controllers\BendaharaController::class);
// Lihat folder
Route::get('/files/{folder}', 'App\Http\Controllers\ShowfolderController@showFilesInFolder')->name('showfolder.index');


// Users 
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');

    
    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');

    Route::get('export/', [UserController::class, 'export'])->name('export');
    //Route::post('/uploadDPA', [FileController::class, 'store'])->name('file.store');
    
});

