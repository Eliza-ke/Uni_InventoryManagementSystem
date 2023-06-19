<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PurchaseorderController;
use App\Http\Controllers\SaleorderController;
use App\Http\Controllers\SupplierController;

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
Route::get('/dashboard', function() {
    return view('dashboard');
} );

Route::get('/saleorder', [SaleorderController::class,'index'])->middleware('auth');
Route::resource('/product', ProductController::class)->middleware('auth');
Route::get('/productIndex/{id}', [ProductController::class, 'index'])->middleware('auth');

Route::resource('/category', CategoryController::class)->middleware('auth');
Route::resource('/supplier', SupplierController::class)->middleware('auth');
Route::resource('/purchaseorder', PurchaseorderController::class)->middleware('auth');
Route::get('/purchaseorder/create/{id}', [PurchaseorderController::class, 'create'])->middleware('auth');
Route::resource('/invoice', InvoiceController::class)->middleware('auth');

Route::resource('/user', UserController::class);

Route::get('/loginform', [AuthController::class, 'showLoginform']);
Route::post('/login', [AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);

