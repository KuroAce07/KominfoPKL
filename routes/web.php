<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Imports\ArsipLamaImport;
use Maatwebsite\Excel\Facades\Excel;
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

//arsip lama
Route::get('/imported-data', [ImportController::class, 'showImportedData'])->name('imported.data');


// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);

// Upload DPA
Route::resource('UploadDPA', App\Http\Controllers\UploadDPAController::class);
Route::get('/UploadDpa', [UploadDPAController::class, 'index'])->name('UploadDpa.index');
Route::post('/UploadDpa', [UploadDPAController::class, 'store'])->name('UploadDpa.store');
Route::get('/ViewDpa', [ViewDPAController::class, 'index'])->name('view_dpa.index');
//Route::get('/', [UploadDPAController::class, 'index'])->name('upload_dpa.index');
//Route::post('/store', [UploadDPAController::class, 'store'])->name('upload_dpa.store');

// View List DPA
Route::resource('ViewDPA', App\Http\Controllers\ViewDPAController::class);

// Route to view the uploaded PDF data (ViewDPA site)
Route::get('/view', [ViewDPAController::class, 'index']);

//tes excel
Route::get('/test-excel', function () {
    $file_path = 'D:/arsip_lama.xlsx';

    // Load the Excel file and get all the rows from the first sheet
    $data = Excel::toArray(new ArsipLamaImport, $file_path);

    // Display the data
    dd($data);
});
//dpa and user
Route::get('/assign-dpa/{dpaId}/{userId}', [Assig::class, 'assignDpa'])->name('assignDpa');

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

