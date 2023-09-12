<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogRegController;
use App\Http\Controllers\DateTimeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CatSuppController;

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
Route::post('/remove-item/{removeItem}', [InventoryController::class, 'removeItem'])->name('remove');
Route::get('/api/getItemDetails/{itemId}', [InventoryController::class, 'getItemDetails']);
Route::post('/update-item',  [InventoryController::class, 'updateTab']);

Route::post('/addSupplier', [CatSuppController::class, 'addSupplier']);
Route::post('/addCategory', [CatSuppController::class, 'addCategory']);
Route::get('/remove-category/{itemCode}', [CatSuppController::class, 'removeCategory']);
Route::get('/remove-supplier/{itemCode}', [CatSuppController::class, 'removeSupplier']);

Route::group(['middleware' => ['session-checker']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/updated-inventory', [InventoryController::class, 'getUpdatedInventory'])->name('updated-inventory');
    Route::get('/CategorynSupplier', [CatSuppController::class, 'updateTable'])->name('CatSupp');
    Route::get('/new-item', [CatSuppController::class, 'updateAdd'])->name('newitem');
    Route::get('/inventory', function () {
        return view('inventory');
    })->name('inventory');

    Route::get('/logs', function () {
        return view('logs');
    })->name('logs');

    Route::get('/custodian', function () {
        return view('custodian');
    })->name('custodian');
});


Route::middleware(['session-checker-login'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
});



Route::get('/test', function () {
    return view('test');
})->name('test');;
