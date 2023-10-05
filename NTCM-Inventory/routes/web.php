<?php

use App\Http\Controllers\CustodianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogRegController;
use App\Http\Controllers\DateTimeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CatSuppController;
use App\Http\Controllers\LogController;

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
Route::get('/remove-item/{removeItem}', [InventoryController::class, 'removeItem'])->name('remove');
Route::get('/getItemDetails/{brandID}/{categoryID}', [InventoryController::class, 'getItemDetails']);
Route::get('/getItemSpecs/{itemID}', [InventoryController::class, 'getItemSpecs']);
Route::post('/update-item',  [InventoryController::class, 'updateTab']);

Route::post('/addSupplier', [CatSuppController::class, 'addSupplier']);
Route::post('/addCategory', [CatSuppController::class, 'addCategory']);
Route::post('/addBrand', [CatSuppController::class, 'addBrand']);
Route::post('/SupplierCategory', [CatSuppController::class, 'supplierToCategory']);
Route::post('/CategoryBrand', [CatSuppController::class, 'categoryToBrand']);
Route::get('//get-categories-for-supplier/{supplierId}', [CatSuppController::class, 'getCategoriesForSupplier']);
Route::get('/remove-category/{itemCode}', [CatSuppController::class, 'removeCategory']);
Route::get('/remove-brand/{itemCode}', [CatSuppController::class, 'removeBrand']);
Route::get('/remove-supplier/{itemCode}', [CatSuppController::class, 'removeSupplier']);

Route::post('/insert-custodian', [CustodianController::class, 'createCustodian']);

Route::group(['middleware' => ['session-checker']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/updated-custodian', [CustodianController::class, 'getUpdatedCustodian'])->name('updated-custodian');
    Route::get('/updated-inventory', [InventoryController::class, 'getUpdatedInventory'])->name('updated-inventory');
    Route::get('/create-custodianform', [CustodianController::class, 'getUpdatedCustodian1'])->name('custodian2');
    Route::get('/editItems/{itemID}', [InventoryController::class, 'editItem'])->name('editItem');
    Route::post('/addEmployee', [CustodianController::class, 'addEmployee']);
    Route::get('/supplier', [CatSuppController::class, 'updateTable2'])->name('suppliers');
    Route::get('/brands', [CatSuppController::class, 'updateTable1'])->name('brands');
    Route::get('/updated-category', [CatSuppController::class, 'updateCateg'])->name('categories');
    Route::get('/check-brand/{categoryID}', [CatSuppController::class, 'checkBrand']);
    Route::get('/new-item', [CatSuppController::class, 'updateAdd'])->name('newitem');
    Route::get('/logs', [LogController::class, 'updateLogTable'])->name('logs');
    Route::get('/print/{custodianID}', [CustodianController::class, 'toPrint'])->name('print');
    Route::get('/BrandInfo/{id}', [CatSuppController::class, 'getBrandDetail']);
    Route::get('/inventory', function () {
        return view('inventory');
    })->name('inventory');

    Route::get('/custodian', function () {
        return view('custodian');
    })->name('custodian');

    Route::get('/equipment', function () {
        return view('equipment');
    })->name('equipment');

    Route::get('/form', function () {
        return view('form');
    })->name('form');

    Route::get('/employee', [CatSuppController::class, 'employeePage'])->name('employee');



});


Route::middleware(['session-checker-login'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
});



Route::get('/test', function () {
    return view('test');
})->name('test');;
