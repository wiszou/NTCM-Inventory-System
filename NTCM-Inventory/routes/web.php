<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogRegController;
use App\Http\Controllers\DateTimeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\InventoryController;


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

Route::get('/time-date', [DateTimeController::class, 'getDateTime'])->name('timedate');


Route::post('/register-user', [LogRegController::class, 'registerUser'])->name('register');
Route::post('/login-user', [LogRegController::class, 'loginUser'])->name('login');
Route::get('/log-out', [LogRegController::class, 'logOut'])->name('logout');
Route::post('/insert-item', [InventoryController::class, 'addItem'])->name('insert');

Route::get('/inventory', [InventoryController::class, 'getAllItems']);
Route::get('/get-updated-inventory', [InventoryController::class, 'getUpdatedInventory']);

Route::group(['middleware' => ['session-checker']], function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
});


Route::middleware(['session-checker-login'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');;
});



Route::get('/test', function () {
    return view('test');
})->name('test');;