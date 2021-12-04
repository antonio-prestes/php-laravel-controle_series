<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\TemporadaController;
use App\Http\Controllers\EpisodioController;
use App\Mail\NewSerie;

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
    return view('welcome');
});
Route::get('/email', function () {
    return new NewSerie('Teste', 2, 1);
});
Route::get('/send-email', function () {
    $email = new NewSerie('Teste', 2, 1);

    $user = (object)[
        'email' => 'diegoantoniodasp@hotmail.com',
        'name' => 'Diego'
    ];

    Mail::to($user)->send($email);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/series', [SeriesController::class, 'index'])->name('series.index');
    Route::get('/series/criar', [SeriesController::class, 'create'])->name('series.create');
    Route::post('/series/criar', [SeriesController::class, 'store'])->name('series.store');
    Route::delete('/remover/{id}', [SeriesController::class, 'destroy'])->name('series.destroy');
    Route::post('/series/{id}/edit', [SeriesController::class, 'edit'])->name('series.edit');
    Route::get('/series/{serieId}/temporadas', [TemporadaController::class, 'index'])->name('temporada.index');
    Route::get('/temporadas/{temporada}/episodios', [EpisodioController::class, 'index'])->name('episodio.index');
    Route::post('/temporadas/{temporada}/episodios/assistir', [EpisodioController::class, 'update'])->name('episodio.update');
});



