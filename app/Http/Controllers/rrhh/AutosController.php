<?php

namespace App\Http\Controllers\rrhh;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\rrhh\Auto;

class AutosController extends Controller
{
    public function index(){
        $autos =Auto::all();
        return response()->json([
            "msg"=>"Autos cargados de manera exitosa",
            "data"=>$autos,
            "status"=>200,
        ],200);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre_carro' => 'required|max:60',
            'año'=>'required|max:60',
            'persona_id'=>'required|int',
            'modelo_id'=>'required|int'
        ]);

        if($validator->fails())
        return response()->json([
            "msg"=>"Error en las validaciones",
            "data"=>$validator->errors(),
            "status"=>406,
        ],406);

        $autos= new Auto();
        $autos->nombre_carro = $request->nombre_carro;
        $autos->año = $request->año;
        $autos->persona_id = $request->persona_id;
        $autos->modelo_id = $request->modelo_id;
        if($autos->save())
        return response()->json([
            "msg"=>"Auto agregado satisfactoriamente",
            "data"=> $autos,
            "status"=>201,
        ],201);
        return response()->json([
            "msg"=>"Ocurrio un error al crear el auto",
            "data"=> $autos,
            "status"=>500,
        ],500);
    }

    public function update(Request $request, int $id){

        $validator = Validator::make($request->all(), [
            'nombre_carro' => 'required|max:60',
            'año'=>'required|max:60',
            'persona_id'=>'required|int',
            'modelo_id'=>'required|int'
        ]);

        if($validator->fails())
        return response()->json([
            "msg"=>"Error en las validaciones",
            "data"=>$validator->errors(),
            "status"=>406,
        ],406);

        
        $autos = Auto::find($id);
        if(!$autos)
        return response()->json([
            "msg"=>"El auto no existe",
            "data"=>$id,
            "status"=>404,
        ],404);

       
        $autos->nombre_carro = $request->nombre_carro;
        $autos->año = $request->año;
        $autos->persona_id = $request->persona_id;
        $autos->modelo_id = $request->modelo_id;
        $autos->save();
        return response()->json([
            "msg"=>"Auto actualizado satisfactoriamente",
            "data"=> $autos,
            "status"=>200,
        ],200);
    }

    public function delete($id){

        $autos= Auto::find($id);
        if(!$autos)
        return response()->json([
            "msg"=>"El auto no existe",
            "data"=>$id,
            "status"=>404,
        ],404);


        $autos->delete();
        if($autos->trashed())
        return response()->json([
            "msg"=>"Auto borrado satisfactoriamente",
            "data"=> $autos,
            "status"=>200,
        ],200);
        return response()->json([
            "msg"=>"Ocurrio un error al eliminar",
            "data"=> $autos,
            "status"=>500,
        ],500);
    }

    public function restore($id){  
        $autos = Auto::withTrashed()->find($id);
        if(!$autos)
        return response()->json([
            "msg"=>"El auto no existe",
            "data"=>$id,
            "status"=>404,
        ],404);

        $autos->restore();
        if($autos)
        return response()->json([
            "msg"=>"Auto restaurado satisfactoriamente",
            "data"=> $autos,
            "status"=>200,
        ],200);
        return response()->json([
            "msg"=>"Ocurrio un error al restaurar",
            "data"=> $autos,
            "status"=>500,
        ],500);
    }
}
