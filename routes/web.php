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

    // 資訊管理路由
    Route::get('/information', function () {
        return view('information.index');
    })->name('information.index');
});

// Information Routes
Route::group(['prefix' => 'information', 'middleware' => ['auth.token']], function () {
    // 大洲管理
    Route::get('/continent', [ContinentController::class, 'index'])->name('continent.index');
    Route::get('/continent/create', [ContinentController::class, 'create'])->name('continent.create');
    Route::post('/continent', [ContinentController::class, 'store'])->name('continent.store');
    Route::get('/continent/{id}/edit', [ContinentController::class, 'edit'])->name('continent.edit');
    Route::put('/continent/{id}', [ContinentController::class, 'update'])->name('continent.update');
    Route::delete('/continent/{id}', [ContinentController::class, 'destroy'])->name('continent.destroy');

    // 國家管理
    Route::get('/country', [CountryController::class, 'index'])->name('country.index');
    Route::get('/country/create', [CountryController::class, 'create'])->name('country.create');
    Route::post('/country', [CountryController::class, 'store'])->name('country.store');
    Route::get('/country/{id}/edit', [CountryController::class, 'edit'])->name('country.edit');
    Route::put('/country/{id}', [CountryController::class, 'update'])->name('country.update');
    Route::delete('/country/{id}', [CountryController::class, 'destroy'])->name('country.destroy');

    // 城市管理
    Route::get('/city', [CityController::class, 'index'])->name('city.index');
    Route::get('/city/create', [CityController::class, 'create'])->name('city.create');
    Route::post('/city', [CityController::class, 'store'])->name('city.store');
    Route::get('/city/{id}/edit', [CityController::class, 'edit'])->name('city.edit');
    Route::put('/city/{id}', [CityController::class, 'update'])->name('city.update');
    Route::delete('/city/{id}', [CityController::class, 'destroy'])->name('city.destroy');

    // API 路由
    Route::prefix('api')->group(function () {
        Route::delete('/continent/{id}', [ContinentController::class, 'destroy']);
        Route::delete('/country/{id}', [CountryController::class, 'destroy']);
        Route::delete('/city/{id}', [CityController::class, 'destroy']);
    });
});
