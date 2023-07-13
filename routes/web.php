<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DdController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SaleorderController;
use App\Http\Controllers\PurchaseorderController;

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
Route::get('/dashboard', [DataController::class, 'index']);
Route::get('/filter/{year}', [DataController::class, 'filterByYear'])->name('filter');

Route::get('/saleorder', [SaleorderController::class,'index'])->middleware('auth');
Route::resource('/product', ProductController::class)->middleware('auth');
Route::get('/productIndex/{id}', [ProductController::class, 'index'])->middleware('auth');
Route::post('/product/search', [ProductController::class, 'search'])->name('search');


Route::resource('/category', CategoryController::class)->middleware('auth');
Route::resource('/supplier', SupplierController::class)->middleware('auth');
Route::resource('/purchaseorder', PurchaseorderController::class)->middleware('auth');
Route::get('/purchaseorder/create/{id}', [PurchaseorderController::class, 'create'])->middleware('auth');
Route::resource('/invoice', InvoiceController::class)->middleware('auth');

Route::resource('/user', UserController::class)->middleware('auth');

Route::get('/loginform', [AuthController::class, 'showLoginform']);
Route::post('/login', [AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);

