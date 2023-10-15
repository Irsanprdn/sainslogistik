<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WBSController;
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

Route::get('/', [Controller::class, 'compro'])->name('compro');

Route::post('/search', [WBSController::class, 'wbs_search'])->name('wbs.search');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'procLogin'])->name('proc.login');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [AdminPanelController::class, 'home'])->name('home');
        Route::prefix('home')->group(function () {
            Route::get('/', [AdminPanelController::class, 'home'])->name('home');
            Route::post('/edit', [AdminPanelController::class, 'home_edit'])->name('home.edit');
            Route::post('/post', [AdminPanelController::class, 'home_post'])->name('home.post');
            Route::post('/social_media/post', [AdminPanelController::class, 'home_socmed_post'])->name('home_social_media.post');
            Route::get('/delete/{id}', [AdminPanelController::class, 'home_delete'])->name('home.delete');
        });

        Route::prefix('about')->group(function () {
            Route::get('/', [AdminPanelController::class, 'about'])->name('about');
            Route::post('/post', [AdminPanelController::class, 'about_post'])->name('about.post');
        });

        Route::prefix('activity')->group(function () {
            Route::get('/', [AdminPanelController::class, 'activity'])->name('activity');
            Route::post('/edit', [AdminPanelController::class, 'activity_edit'])->name('activity.edit');
            Route::post('/post', [AdminPanelController::class, 'activity_post'])->name('activity.post');
            Route::get('/delete/{id}', [AdminPanelController::class, 'activity_delete'])->name('activity.delete');
        });

        
        Route::prefix('contact')->group(function () {
            Route::get('/', [AdminPanelController::class, 'contact'])->name('contact');
            Route::post('/post', [AdminPanelController::class, 'contact_post'])->name('contact.post');
        });

        Route::prefix('wbs_data')->group(function () {
            Route::get('/', [WBSController::class, 'wbs_data'])->name('wbs_data');
            Route::post('/export', [WBSController::class, 'wbs_data_export'])->name('wbs_data.export');
            Route::get('/input/{id}', [WBSController::class, 'wbs_data_input'])->name('wbs_data.input');
            Route::post('/post/{id}', [WBSController::class, 'wbs_data_post'])->name('wbs_data.post');
            Route::get('/delete/{id}', [WBSController::class, 'wbs_data_delete'])->name('wbs_data.delete');
            Route::post('/import', [WBSController::class, 'wbs_data_import'])->name('wbs_data.import');
        });
        Route::prefix('master_data')->group(function () {
            Route::get('/', [AdminPanelController::class, 'master_data'])->name('master_data');
            Route::post('/post', [AdminPanelController::class, 'master_data_post'])->name('master_data.post');
            Route::post('/edit', [AdminPanelController::class, 'master_data_edit'])->name('master_data.edit');
            Route::get('/delete/{groupId}/{basicId}', [AdminPanelController::class, 'master_data_delete'])->name('master_data.delete');
        });
    });
});
