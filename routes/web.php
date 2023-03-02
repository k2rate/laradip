<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'index'])->name('catalog');

Route::get('/where', function () {
    return view('where');
})->name('where');

Route::get('/tovar/{tovar_id}/', [App\Http\Controllers\ProductController::class, 'index'])->name('product');

Route::post('/addbucket/{tovar_id}', [App\Http\Controllers\BucketController::class, 'add'])->name('bucket.add');

Route::get('/bucket', [App\Http\Controllers\BucketController::class, 'index'])->name('bucket');

Route::get('/admin', [App\Http\Controllers\Admin\LoginController::class, 'index'])->name('admin');
Route::post('/admin/login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');

Route::middleware([App\Http\Middleware\Admin\Check::class])->group(function () {
    Route::post('/admin/logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');

    Route::get('/admin/panel', [App\Http\Controllers\Admin\PanelController::class, 'index'])->name('admin.panel');
    Route::post('/admin/storeProduct', [App\Http\Controllers\Admin\PanelController::class, 'storeProduct'])->name('admin.storeProduct');
});



/*
Route::get('/home', function () {
return view('main');
})->name('home');
*/