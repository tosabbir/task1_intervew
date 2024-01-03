<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you cann register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return view('index');
})->name('/');


// all admin route here
Route::middleware(['auth','role:admin','verified'])->group(function(){

    // all admin profile related route
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
        Route::get('/admin/logout', 'adminLogout')->name('admin.logout');
        Route::get('/admin/profile', 'adminProfile')->name('admin.profile');
    });


    // all category related url here
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/admin/all/category', 'index')->name('admin.all.category');
        Route::get('/admin/add/category', 'create')->name('admin.add.category');
        Route::post('/admin/category/store', 'store')->name('admin.category.store');
        Route::get('/admin/category/edit/{slug}', 'edit')->name('admin.category.edit');
        Route::post('/admin/category/update', 'update')->name('admin.category.update');
        Route::get('/admin/category/permanentlyDelete/{slug}', 'permanentlyDelete')->name('admin.category.permanentlyDelete');
    });


    // all Admin product related url here
    Route::controller(ProductController::class)->group(function(){
        Route::get('/admin/all/product', 'adminAllProduct')->name('admin.all.product');

        Route::get('/admin/add/product', 'adminAddProduct')->name('admin.add.product');
        Route::post('/admin/store/product', 'adminStoreProduct')->name('admin.store.product');
        Route::get('/admin/product/edit/{slug}', 'adminEditProduct')->name('admin.product.edit');
        Route::post('/admin/update/product', 'adminUpdateProduct')->name('admin.update.product');

        Route::get('/admin/product/permanentlyDelete/{slug}', 'permanentlyDelete')->name('admin.product.permanentlyDelete');
    });

});


// // all user route
Route::middleware(['auth','role:user','verified'])->group(function(){

    Route::controller(UserController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('logout', 'logout')->name('logout');
    });
});

// all guest route here
Route::controller(FrontendController::class)->group(function(){
    // product Details
    Route::get('/product/details/{slug}', 'productDetails')->name('product.details');

});

require __DIR__.'/auth.php';
