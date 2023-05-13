<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\LinkController;

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
// Route Admin
Route::get('okeadmin/', function () {
    return Redirect::to(route('login'));
});

Route::group(['middleware' => ['guest']], function () {
    Route::prefix('okeadmin')->group(function(){
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/process-login', [AuthController::class, 'login'])->name('login_process');
    });
});

Route::group(['middleware' => ['auth']], function() {
    Route::name('banner.')->prefix('okeadmin/banner')->group(function(){
        Route::get('/', [BannerController::class, 'index'])->name('view');
        Route::post('/get', [BannerController::class, 'get'])->name('get');
        Route::post('/store-image', [BannerController::class, 'store_image'])->name('store_image');
        Route::post('/delete-image', [BannerController::class, 'delete_image'])->name('delete_image');
        Route::post('/store', [BannerController::class, 'store'])->name('store');
        Route::delete('/delete/{banner_id}', [BannerController::class, 'destroy'])->name('delete');
    });

    Route::name('category.')->prefix('okeadmin/category')->group(function(){
        Route::get('/', [CategoryController::class, 'index'])->name('view');
        Route::post('/get', [CategoryController::class, 'get'])->name('get');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::post('/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{category_id}', [CategoryController::class, 'destroy'])->name('delete');
    });

    Route::name('content.')->prefix('okeadmin/content')->group(function(){
        Route::get('/', [ContentController::class, 'index'])->name('view');
        Route::post('/get', [ContentController::class, 'get'])->name('get');
        Route::post('/store', [ContentController::class, 'store'])->name('store');
        Route::post('/update', [ContentController::class, 'update'])->name('update');
        Route::get('/sortlist', [ContentController::class, 'sortlist'])->name('sortlist');
        Route::delete('/delete/{content_id}', [ContentController::class, 'destroy'])->name('delete');
    });

    Route::name('setting.')->prefix('okeadmin/setting')->group(function(){
        Route::get('/', [LinkController::class, 'index'])->name('view');
        Route::post('/update', [LinkController::class, 'update'])->name('update');
    });

    Route::get('okeadmin/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route Web
Route::get('/', [HomeController::class, 'index']);
Route::get('/{name}/{id}', [HomeController::class, 'byId'])->name('byId');
Route::post('get-banner', [HomeController::class, 'get_banner'])->name('get_banner');
Route::post('get-links', [HomeController::class, 'get_link_btn'])->name('get_link_btn');

