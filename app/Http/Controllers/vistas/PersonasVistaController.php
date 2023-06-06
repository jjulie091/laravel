<?php

namespace App\Http\Controllers\vistas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rrhh\Persona;
use Inertia\Inertia;

class PersonasVistaController extends Controller
{
    public function index(){
        return Inertia::render('Personas/Index', [
            'personas' => Persona::all()->map(function ($persona) {
                return [
                    'id' => $persona->id,
                    'nombre' => $persona->nombre,
                    'ap_paterno' => $persona->ap_paterno,
                    'ap_materno' =>$persona->ap_materno,
                    'edit_url' => route('personas.update', $persona),
                ];
            })
        ]);
    }
    

    public function create(){
        return Inertia::render('Personas/Create');
    }

    public function store(Request $request){
        $request->validate([
            'nombre' => 'required|max:60',
            'ap_paterno' => 'required|max:60',
            'ap_materno' => 'required|max:60',
        ]);
        $personas = new  Persona($request->input());
        $personas-> save();
        return redirect('personas/index');
    }

    public function edit(Persona $personas){
        return Inertia::render('Personas/Edit', ['personas' => $personas]);
    }

    public function update(Request $request, $persona)
    {
        $persona=Persona::find($persona);
        $request->validate([
            'nombre' => 'required|max:60',
            'ap_paterno' => 'required|max:60',
            'ap_materno' => 'required|max:60',
        ]);
        $persona->update($request->all());
        return redirect('personas/index');
    }

    public function destroy($id){
        $personas= Persona::find($id);
        $personas -> delete();
        return redirect('personas/index');
    }
}
