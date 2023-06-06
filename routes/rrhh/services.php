<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\rrhh\ModelosController;
use App\Http\Controllers\rrhh\AutosController;
use App\Http\Controllers\rrhh\PersonasController;



Route::prefix('v1.0')->group(function(){
    
    Route::get('check', function(){
        return "ok";
    });

    Route::get('personas',
    [PersonasController::class, 'index']);

    Route::post('persona/create',
    [PersonasController::class,'create']);

    Route::put('persona/update/{id}',
    [PersonasController::class, 'update']) ->whereNumber('id');

    Route::delete('persona/delete/{id}',
    [PersonasController::class, 'delete']) ->whereNumber('id');

    Route::get('persona/{id}/autos',
    [PersonasController::class, 'autosPorPersona']) ->whereNumber('id');

    Route::put('persona/restore/{id}',
    [PersonasController::class, 'restore']) ->whereNumber('id');

    /*----------Modelos------------*/

    Route::get('modelos',
    [ModelosController::class, 'index']);

    Route::post('modelo/create',
    [ModelosController::class,'create']);

    Route::put('modelo/update/{id}',
    [ModelosController::class, 'update']) ->whereNumber('id');

    Route::delete('modelo/delete/{id}',
    [ModelosController::class, 'delete']) ->whereNumber('id');
                                        
    Route::put('modelo/restore/{id}',
    [ModelosController::class, 'restore']) ->whereNumber('id');
    
    /*------------------Autos------------------*/

    Route::get('autos',
    [AutosController::class, 'index']);

    Route::post('auto/create',
    [AutosController::class,'create']);

    Route::put('auto/update/{id}',
    [AutosController::class, 'update']) ->whereNumber('id');

    Route::delete('auto/delete/{id}',
    [AutosController::class, 'delete']) ->whereNumber('id');
                                        
    Route::put('auto/restore/{id}',
    [AutosController::class, 'restore']) ->whereNumber('id');


});