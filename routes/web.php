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

    // API 路由
    Route::get('/api/continent', [ContinentController::class, 'apiIndex']);
    Route::post('/api/continent', [ContinentController::class, 'apiStore']);
});
