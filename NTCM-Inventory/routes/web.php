<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogRegController;
use App\Http\Controllers\DateTimeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SessionChecker;
use App\Http\Controllers\SessionCheckerLogin;


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
Route::post('/register-user', [LogRegController::class, 'registerUser'])->name('register');
Route::post('/login-user', [LogRegController::class, 'loginUser'])->name('login');
Route::get('/log-out', [LogRegController::class, 'logOut'])->name('logout');

Route::get('/time-date', [DateTimeController::class, 'getDateTime'])->name('timedate');


Route::group(['middleware' => ['session-checker']], function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
});


Route::middleware(['session-checker-login'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');;
});



Route::get('/inventory', function () {
    return view('inventory');
})->name('inventory');;


Route::get('/test', function () {
    return view('test');
})->name('test');;