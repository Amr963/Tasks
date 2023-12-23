<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
    return 'hello from root';
})->middleware([
    'auth',
    'test:super-admin',
]);

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/notadmin', function () {
    return view('notadmin');
})->name('notadmin');


Route::get('product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
// Route::resource();
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






// Translate ;
// عملا بالميدل وير
// Route::get('/product/translate',[ProductController::class,'translate'])->name('product.translate');

Route::get('/translate',function (){
    return view('translate');
})->name('translate');
Route::post('/change-language', [ProductController::class, 'translate'])->name('change-language');
