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

Route::prefix('cms_site')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'procLogin'])->name('proc.login');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/', [AdminPanelController::class, 'home'])->name('home');
        Route::prefix('home')->group(function () {
            Route::get('/', [AdminPanelController::class, 'home'])->name('home');
            Route::post('/post', [AdminPanelController::class, 'home_post'])->name('home.post');       
        });

        
        Route::prefix('client')->group(function () {
            Route::get('/', [AdminPanelController::class, 'client'])->name('client');
            Route::post('/post', [AdminPanelController::class, 'client_post'])->name('client.post');
            Route::get('/delete/{client_id}', [AdminPanelController::class, 'client_delete'])->name('client.delete');
        });

        Route::prefix('footer')->group(function () {
            Route::get('/', [AdminPanelController::class, 'footer'])->name('footer');
            Route::post('/post', [AdminPanelController::class, 'footer_post'])->name('footer.post');       
        });

        Route::prefix('about')->group(function () {
            Route::get('/', [AdminPanelController::class, 'about'])->name('about');
            Route::post('/post', [AdminPanelController::class, 'about_post'])->name('about.post');
        });

        Route::prefix('service')->group(function () {
            Route::get('/', [AdminPanelController::class, 'service'])->name('service');
            Route::post('/post', [AdminPanelController::class, 'service_post'])->name('service.post');
        });

       
        
        
        Route::prefix('linkedin')->group(function () {
            Route::get('/', [AdminPanelController::class, 'linkedin'])->name('linkedin');
            Route::post('/post', [AdminPanelController::class, 'linkedin_post'])->name('linkedin.post');
        });

      
    });
});
