<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->to('/catalog');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about',  [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');

Route::view('/where', 'where')->name('where');
Route::view('/terms', 'terms')->name('terms');

Route::get('/product/{product_id}/', [App\Http\Controllers\ProductController::class, 'index'])->name('product');

Route::post('/addbucket', [App\Http\Controllers\BucketController::class, 'ajaxAdd'])->name('bucket.add');
Route::post('/removebucket', [App\Http\Controllers\BucketController::class, 'ajaxRemove'])->name('bucket.remove');
Route::post('/checkoutSubmit', [App\Http\Controllers\BucketController::class, 'checkoutSubmit'])->name('bucket.checkoutSubmit');

Route::get('/checkout', [App\Http\Controllers\BucketController::class, 'checkout'])->name('bucket.checkout');
Route::get('/bucket', [App\Http\Controllers\BucketController::class, 'index'])->name('bucket');

Route::get('/admin', [App\Http\Controllers\Admin\LoginController::class, 'index'])->name('admin');
Route::post('/admin/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');

Route::middleware([App\Http\Middleware\Admin\Check::class])->group(function () {
    Route::get('/admin/logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');

    Route::get('/admin/panel', [App\Http\Controllers\Admin\PanelController::class, 'index'])->name('admin.panel');
    Route::post('/admin/storeProduct', [App\Http\Controllers\Admin\PanelController::class, 'storeProduct'])->name('admin.storeProduct');
    Route::get('/admin/product/{product_id}', [App\Http\Controllers\Admin\PanelController::class, 'viewProduct'])->name('admin.product');
    Route::post('/admin/editProduct', [App\Http\Controllers\Admin\PanelController::class, 'editProduct'])->name('admin.editProduct');
    Route::post('/admin/editProductImage', [App\Http\Controllers\Admin\PanelController::class, 'editProductImage'])->name('admin.editProductImage');
    Route::post('/admin/deleteProduct', [App\Http\Controllers\Admin\PanelController::class, 'deleteProduct'])->name('admin.deleteProduct');
    Route::post('/admin/addCategory', [App\Http\Controllers\Admin\PanelController::class, 'addCategory'])->name('admin.addCategory');
    Route::post('/admin/deleteCategory', [App\Http\Controllers\Admin\PanelController::class, 'deleteCategory'])->name('admin.deleteCategory');
    Route::post('/admin/finishCheckout', [App\Http\Controllers\Admin\PanelController::class, 'finishCheckout'])->name('admin.finishCheckout');
});