<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\WeatherController;

Route::get('/', function () {
    return view('/login');
});

// Route logout
Route::get('/logout', function () {
    return redirect('/login');
});



Route::get('/login', function () {
    return view('login');
})->name('login');

Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/profil', function () {
    return view('profil');
})->name('profil')->middleware('auth');

Route::prefix('monitoring-lahan')->group(function () {
    Route::get('/', [MonitoringController::class, 'locations'])->name('monitoring.lahan');  // Halaman monitoring lahan
    Route::get('/search-location', [MonitoringController::class, 'searchLocation']);  // Endpoint untuk search lokasi
    Route::post('/save-location', [MonitoringController::class, 'saveLocation'])->middleware('auth');
});

Route::get('/weather', [WeatherController::class, 'getWeather']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/modul-belajar', function() {
    return view('modul_belajar');
})->name('modul-education')->middleware('auth');

Route::get('/monitoring-lahan/get-weather-data', [MonitoringController::class, 'getWeatherData']);

Route::post('/save-location', [MonitoringController::class, 'saveLocation'])->middleware('auth');


use App\Http\Controllers\ForumController;
use App\Http\Controllers\ForumReplyController;
use App\Http\Controllers\modul_belajarController;

Route::prefix('forum')->name('forum.')->group(function () {
    // Halaman utama forum
    Route::get('/', [ForumController::class, 'index'])->name('index');

    // Halaman kategori forum
    Route::get('/category/{category}', [ForumController::class, 'category'])->name('category');

    // Halaman buat topik baru
    Route::get('/create', [ForumController::class, 'create'])->name('create');
    Route::post('/', [ForumController::class, 'store'])->name('store');

    // Halaman detail topik
    Route::get('/{topic:slug}', [ForumController::class, 'show'])->name('show');

    // Halaman edit topik
    Route::get('/{topic:slug}/edit', [ForumController::class, 'edit'])->name('edit');
    Route::put('/{topic:slug}', [ForumController::class, 'update'])->name('update');

    // Hapus topik
    Route::delete('/{topic:slug}', [ForumController::class, 'destroy'])->name('destroy');

    // Balasan untuk topik
    Route::post('/{topic:slug}/reply', [ForumReplyController::class, 'store'])->name('reply.store');

    // Edit balasan
    Route::get('/reply/{reply}/edit', [ForumReplyController::class, 'edit'])->name('reply.edit');
    Route::put('/reply/{reply}', [ForumReplyController::class, 'update'])->name('reply.update');

    // Hapus balasan
    Route::delete('/reply/{reply}', [ForumReplyController::class, 'destroy'])->name('reply.destroy');

    // Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('article.show');
    // Route::get('/video/{slug}', [VideoController::class, 'show'])->name('video.show');

});

use App\Http\Controllers\ModulBelajarController;

Route::get('/modul-belajar/{materi}', [ModulBelajarController::class, 'show'])->name('belajar.show');

