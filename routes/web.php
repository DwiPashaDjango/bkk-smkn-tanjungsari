<?php

use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestArticleController;
use App\Http\Controllers\GuestProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Artisan;
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
// auth controller
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/account-verify/{id}/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');


Route::get('/', [BerandaController::class, 'index']);
Route::get('/profile', [GuestProfileController::class, 'index']);
Route::post('/user-profile', [BerandaController::class, 'save_user_profile'])->name('user.profile');
Route::get('/user-profile/pdf/', [GuestProfileController::class, 'getProfilePdf'])->name('user.profile.pdf');
Route::post('/users/update/profile', [GuestProfileController::class, 'updateProfile'])->name('user.profile.update');

Route::get('/lokers', [GuestArticleController::class, 'index'])->name('guest.article');
Route::get('/lokers/reading/', [GuestArticleController::class, 'show'])->name('guest.article.show');


// admin controller {Dashboard, Data Alumni, Data Loker}
Route::group(['middleware' => ['auth', 'cekRole:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/data-alumni', [AlumniController::class, 'index'])->name('alumni');
    Route::get('/data-alumni/{id}', [AlumniController::class, 'show'])->name('show-alumni');
    Route::get('/data-alumni/{id}/edit', [AlumniController::class, 'edit'])->name('edit.alumni');
    Route::put('/data-alumni/update/{id}', [AlumniController::class, 'update'])->name('update.alumni');
    Route::delete('/data-alumni/{id}', [AlumniController::class, 'destroy'])->name('delete.alumni');
    Route::get('/data-alumni/export/{thn_lulus}', [AlumniController::class, 'exportPdf'])->name('export.alumni');
    Route::post('/data-alumni/import', [AlumniController::class, 'importAlumni'])->name('import.alumni');
    Route::get('/data-alumni/generate/{id}/', [AlumniController::class, 'generatePdfUser'])->name('reading.alumni.cv');
    Route::get('/data-admin/export/excel', [AlumniController::class, 'exportUser'])->name('export.excel.alumni');

    Route::get('/data-lokers', [AdminArticleController::class, 'index'])->name('admin.lokers');
    Route::get('/data-lokers/create', [AdminArticleController::class, 'create'])->name('admin.lokers.create');
    Route::post('/data-lokers/store', [AdminArticleController::class, 'store'])->name('admin.lokers.post');
    Route::get('/data-lokers/show/', [AdminArticleController::class, 'edit'])->name('admin.loker.edit');
    Route::put('/data-lokers/{id}', [AdminArticleController::class, 'update'])->name('admin.lokers.update');
    Route::delete('/data-lokers/{id}', [AdminArticleController::class, 'destroy'])->name('admin.lokers.destroy');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings/store', [SettingController::class, 'profileSekolah'])->name('settings.post');
    Route::post('/settings/update-profile', [SettingController::class, 'updateProfile'])->name('settings.update.profile');
    Route::post('/settings/reset-password', [SettingController::class, 'resetPassword'])->name('settings.reset.password');
});
Route::get('/settings/getSekolah', [SettingController::class, 'getSekolah'])->name('settings.json');


Route::get('/symlink', function () {
    Artisan::call('route:cache');
    Artisan::call('route:clear');
});
