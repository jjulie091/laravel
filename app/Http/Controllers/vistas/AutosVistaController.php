<?php

namespace App\Http\Controllers\vistas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rrhh\Auto;
use Inertia\Inertia;

class AutosVistaController extends Controller
{
    public function index(){
        return Inertia::render('Autos/Index', [
            'autos' => Auto::all()->map(function ($autos) {
                return [
                    'id' => $autos->id,
                    'nombre_carro' => $autos->nombre_carro,
                    'año'=>$autos->año,
                    'persona_id'=>$autos->persona_id,
                    'modelo_id'=>$autos->modelo_id,
                    'edit_url' => route('autos.update', $autos),
                ];
            })
        ]);
    }

    public function create(){
        return Inertia::render('Autos/Create');
    }

    public function store(Request $request){
        $request->validate([
            'nombre_carro' => 'required|max:60',
            'año'=>'required|max:60',
            'persona_id'=>'required|int',
            'modelo_id'=>'required|int'
        ]);
        $autos = new  Auto($request->input());
        $autos-> save();
        return redirect('autos/index');
    }

    public function edit(Auto $autos){
        return Inertia::render('Autos/Edit', ['autos' => $autos]);
    }

    public function update(Request $request, $autos)
    {
        $autos=Auto::find($autos);
        $request->validate([
            'nombre_carro' => 'required|max:60',
            'año'=>'required|max:60',
            'persona_id'=>'required|int',
            'modelo_id'=>'required|int'
        ]);
        $autos->update($request->all());
        return redirect('autos/index');
    }

    public function destroy($id){
        $autos= Auto::find($id);
        $autos -> delete();
        return redirect('autos/index');
    }
}
