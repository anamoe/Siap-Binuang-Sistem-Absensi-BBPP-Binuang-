<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BmnController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', function () {
//     return view('home');
// });
// Route::get('/create', function () {
//     return view('create');
// });


//autentikasi
Route::get('/login', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::get('/', [AuthController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/postlogin', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//dashboard
// Route::middleware(['roles:admin,pegawai','auth'])->group(function(){
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });

Route::middleware(['roles:admin', 'auth'])->group(function () {
    Route::get('/dashboard-admin', [DashboardController::class, 'dashboard_admin'])->name('dashboard-admin');
    Route::resource('/dashboard-aset', AsetController::class);

    Route::get('/bmn/import', [BmnController::class, 'showImportForm']);
    Route::post('/bmn/import', [BmnController::class, 'import'])->name('bmn.import');

    Route::resource('bmn', BmnController::class);

});
Route::middleware(['roles:pegawai', 'auth'])->group(function () {
    Route::get('/dashboard-pegawai', [DashboardController::class, 'dashboard_pegawai'])->name('dashboard-pegawai');
});
Route::get('/dashboardqr/{uuid}', [AsetController::class, 'showqr'])->name('dashboardqr');

Route::get('/scan', function () {
    return view('qrcode.scan');
})->name('scan.qrcode');
Route::get('/get-asset/{uuid}', [BmnController::class, 'getAsset']);

Route::get('/labels', [BmnController::class, 'printIndex'])
    ->name('labels.index');



// //User
// Route::middleware(['roles:Admin,SuperAdmin','auth'])->group(function(){
//     Route::get('/dashboard/users', [UserController::class, 'index'])->name('users.index');
//     Route::post('/dashboard/users/store', [UserController::class, 'store'])->name('users.store');
//     Route::delete('/dashboard/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
// });
