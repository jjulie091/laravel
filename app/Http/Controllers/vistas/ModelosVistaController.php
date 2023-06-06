<?php

namespace App\Http\Controllers\vistas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rrhh\Modelo;
use Illuminate\Database\Eloquent\Model;
use Inertia\Inertia;

class ModelosVistaController extends Controller
{

    public function index(){
        return Inertia::render('Modelos/Index', [
            'modelos' => Modelo::all()->map(function ($modelo) {
                return [
                    'id' => $modelo->id,
                    'nombre_modelo' => $modelo->nombre_modelo,
                    'edit_url' => route('modelos.update', $modelo),
                ];
            })
        ]);
    }

    public function create(){
        return Inertia::render('Modelos/Create');
    }

    public function store(Request $request){
        $request->validate([
            'nombre_modelo' => 'required|max:60',
        ]);
        $modelos = new  Modelo($request->input());
        $modelos-> save();
        return redirect('modelos/index');
    }

    public function edit(Modelo $modelos){
        return Inertia::render('Modelos/Edit', ['modelos' => $modelos]);
    }

    
    public function update(Request $request, $modelo)
    {
        $modelo=Modelo::find($modelo);
        $request->validate([
            'nombre_modelo' => 'required|max:60',
        ]);
        $modelo->update($request->all());
        return redirect('modelos/index');

    }


    public function destroy(Modelo $modelos, $id){
        $modelos= Modelo::find($id);
        $modelos -> delete();
        return redirect('modelos/index');
    }

}
