<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContinentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware('auth.token')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // 添加選單路由
    Route::get('/information', function () {
        return view('information.index');
    })->name('information.index');
});

// Information Routes
Route::group(['prefix' => 'information', 'middleware' => ['check.token']], function () {
    Route::get('/continent', [ContinentController::class, 'index']);
    Route::post('/continent', [ContinentController::class, 'store']);
    Route::get('/country', [CountryController::class, 'index']);
    Route::post('/country', [CountryController::class, 'store']);
    Route::get('/city', [CityController::class, 'index']);
});
