<?php

namespace App\Http\Controllers\rrhh;

use App\Http\Controllers\Controller;
use App\Models\rrhh\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModelosController extends Controller
{
    public function index(){
        $modelos =Modelo::all();
        return response()->json([
            "msg"=>"Modelos cargados de manera exitosa",
            "data"=>$modelos,
            "status"=>200,
        ],200);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre_modelo' => 'required|max:60',
        ]);

        if($validator->fails())
        return response()->json([
            "msg"=>"Error en las validaciones",
            "data"=>$validator->errors(),
            "status"=>406,
        ],406);

        $modelo = new Modelo();
        $modelo->nombre_modelo = $request->nombre_modelo;
        if($modelo->save())
        return response()->json([
            "msg"=>"Modelo agregado satisfactoriamente",
            "data"=> $modelo,
            "status"=>201,
        ],201);
        return response()->json([
            "msg"=>"Ocurrio un error al crear el modelo",
            "data"=> $modelo,
            "status"=>500,
        ],500);
    }

    public function update(Request $request, int $id){

        $validator = Validator::make($request->all(), [
            'nombre_modelo' => 'required|max:60',
        ]);

        if($validator->fails())
        return response()->json([
            "msg"=>"Error en las validaciones",
            "data"=>$validator->errors(),
            "status"=>406,
        ],406);

        
        $modelo= Modelo::find($id);
        if(!$modelo)
        return response()->json([
            "msg"=>"El modelo no existe",
            "data"=>$id,
            "status"=>404,
        ],404);

       
        $modelo->nombre_modelo = $request->nombre_modelo;
        $modelo->save();
        return response()->json([
            "msg"=>"Modelo actualizado satisfactoriamente",
            "data"=> $modelo,
            "status"=>200,
        ],200);
    }

    public function delete($id){

        $modelos= Modelo::find($id);
        if(!$modelos)
        return response()->json([
            "msg"=>"El modelo no existe",
            "data"=>$id,
            "status"=>404,
        ],404);


        $modelos->delete();
        if($modelos->trashed())
        return response()->json([
            "msg"=>"Modelo borrado satisfactoriamente",
            "data"=> $modelos,
            "status"=>200,
        ],200);
        return response()->json([
            "msg"=>"Ocurrio un error al eliminar",
            "data"=> $modelos,
            "status"=>500,
        ],500);
    }

    public function restore($id){  
        $modelos = Modelo::withTrashed()->find($id);
        if(!$modelos)
        return response()->json([
            "msg"=>"El modelo no existe",
            "data"=>$id,
            "status"=>404,
        ],404);

        $modelos->restore();
        if($modelos)
        return response()->json([
            "msg"=>"Modelo restaurado satisfactoriamente",
            "data"=> $modelos,
            "status"=>200,
        ],200);
        return response()->json([
            "msg"=>"Ocurrio un error al restaurar",
            "data"=> $modelos,
            "status"=>500,
        ],500);
    }
}
