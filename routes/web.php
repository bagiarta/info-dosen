<?php

use App\Http\Controllers\BackOffice\DosenController;
use App\Http\Controllers\BackOffice\PublicationCategoryController;
use App\Http\Controllers\BackOffice\PublicationController;
use App\Http\Controllers\BackOffice\PublicationSubCategoryController;
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

Route::get('/', function () {
    return view('front-page/index');
})->name('home');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetDataPPDIKTIController;
use App\Http\Controllers\InfoDosenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

Route::get('lecturer-info',[InfoDosenController::class,'index'])->name('info-dosen.index');
Route::get('lecturer-info/ppdikti/{id}',[InfoDosenController::class,'ppdikti_detail'])->name('info-dosen.ppdikti_detail');
Route::get('lecturer-info/{encrypt_id}',[InfoDosenController::class,'detail'])->name('info-dosen.detail');
// Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::redirect('backoffice','backoffice/dashboard');
Route::get('get-data-ppdikti',[GetDataPPDIKTIController::class,'index']);
Route::middleware('auth')->prefix('backoffice')->name('backoffice.')->group(function(){
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::resource('/dosen', DosenController::class);
	Route::resource('/publication', PublicationController::class);
	Route::resource('/publication-category', PublicationCategoryController::class);
	Route::resource('/publication-sub-category', PublicationSubCategoryController::class);
});
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		$user = User::where('id',auth()->user()->id)->first();
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
	Route::post('post-user-profile',[ProfileController::class,'post_user_profile'])->name('post-user-profile');
});
