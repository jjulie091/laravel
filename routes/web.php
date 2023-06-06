<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\vistas\AutosVistaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\vistas\ModelosVistaController;
use App\Http\Controllers\vistas\PersonasVistaController;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    /*-------------MODELOS--------------*/
    Route::get('/modelos/index', [ModelosVistaController::class, 'index'])->name('modelos.index');
    Route::get('/modelos/create', [ModelosVistaController::class, 'create'])->name('modelos.create');
    Route::post('/modelos/create', [ModelosVistaController::class, 'store'])->name('modelos.store');
    Route::get('/modelos/edit/{id}', [ModelosVistaController::class, 'edit'])->name('modelos.edit');
    Route::put('/modelos/edit/{id}', [ModelosVistaController::class, 'update'])->name('modelos.update');
    Route::delete('/modelos/{modelo}', [ModelosVistaController::class, 'destroy'])->name('modelos.destroy');
    /*-------------PERSONAS--------------*/
    Route::get('/personas/index', [PersonasVistaController::class, 'index'])->name('personas.index');
    Route::get('/personas/create', [PersonasVistaController::class, 'create'])->name('personas.create');
    Route::post('/personas/create', [PersonasVistaController::class, 'store'])->name('personas.store');
    Route::get('/personas/edit/{id}', [PersonasVistaController::class, 'edit'])->name('personas.edit');
    Route::put('/personas/edit/{id}', [PersonasVistaController::class, 'update'])->name('personas.update');
    Route::delete('/personas/{persona}', [PersonasVistaController::class, 'destroy'])->name('personas.destroy');
    /*---------------AUTOS----------------- */
    Route::get('/autos/index', [AutosVistaController::class, 'index'])->name('autos.index');
    Route::get('/autos/create', [AutosVistaController::class, 'create'])->name('autos.create');
    Route::post('/autos/create', [AutosVistaController::class, 'store'])->name('autos.store');
    Route::get('/autos/edit/{id}', [AutosVistaController::class, 'edit'])->name('autos.edit');
    Route::put('/autos/edit/{id}', [AutosVistaController::class, 'update'])->name('autos.update');
    Route::delete('/autos/{auto}', [AutosVistaController::class, 'destroy'])->name('autos.destroy');
    //Route::resource('personas', PersonasVistaController::class);
    //Route::resource('autos', AutosVistaController::class);      
    //Route::resource('modelos', ModelosVistaController::class);
    
});

require __DIR__.'/auth.php';
