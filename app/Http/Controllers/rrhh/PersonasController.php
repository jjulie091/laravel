<?php

namespace App\Http\Controllers\rrhh;

use App\Http\Controllers\Controller;
use App\Models\rrhh\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonasController extends Controller
{
    public function index(){
        $personas =Persona::all();
        return response()->json([
            "msg"=>"Personas cargadas de manera exitosa",
            "data"=>$personas,
            "status"=>200,
        ],200);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:60',
            'ap_paterno' => 'required|max:60',
            'ap_materno' => 'required|max:60',
        ]);

        if($validator->fails())
        return response()->json([
            "msg"=>"Error en las validaciones",
            "data"=>$validator->errors(),
            "status"=>406,
        ],406);

        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->ap_paterno=$request->ap_paterno;
        $persona->ap_materno=$request->ap_materno;
        if($persona->save())
        return response()->json([
            "msg"=>"Persona agregada satisfactoriamente",
            "data"=> $persona,
            "status"=>201,
        ],201);
        return response()->json([
            "msg"=>"Ocurrio un error al crear la persona",
            "data"=> $persona,
            "status"=>500,
        ],500);
    }

    public function update(Request $request, int $id){

        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:60',
            'ap_paterno' => 'required|max:60',
            'ap_materno' => 'required|max:60',
        ]);


        //si lo que manda el usuario no cumplecon los requerimientos la manda error
        if($validator->fails())
        return response()->json([
            "msg"=>"Error en las validaciones",
            "data"=>$validator->errors(),
            "status"=>406,
        ],406);

        //si no existe la persona le mandaría un error
         $persona= Persona::find($id);
        if(!$persona)
        return response()->json([
            "msg"=>"La persona no existe",
            "data"=>$id,
            "status"=>404,
        ],404);

       
        $persona->nombre = $request->nombre;
        $persona->ap_paterno= $request->ap_paterno;
        $persona->ap_materno= $request->ap_materno;
        $persona->save();
        return response()->json([
            "msg"=>"Persona actualizada satisfactoriamente",
            "data"=> $persona,
            "status"=>200,
        ],200);
    }

    public function delete($id){
        //si no existe la persona le mandaría un error
        $persona= Persona::find($id);
        if(!$persona)
        return response()->json([
            "msg"=>"La persona no existe",
            "data"=>$id,
            "status"=>404,
        ],404);


        $persona->delete();
        if($persona->trashed())
        return response()->json([
            "msg"=>"Persona borrada satisfactoriamente",
            "data"=> $persona,
            "status"=>200,
        ],200);
        return response()->json([
            "msg"=>"Ocurrio un error al eliminar",
            "data"=> $persona,
            "status"=>500,
        ],500);
    }

    public function restore($id){  
        $persona = Persona::withTrashed()->find($id);
        if(!$persona)
        return response()->json([
            "msg"=>"La persona no existe",
            "data"=>$id,
            "status"=>404,
        ],404);

        $persona->restore();
        if($persona)
        return response()->json([
            "msg"=>"Persona restaurada satisfactoriamente",
            "data"=> $persona,
            "status"=>200,
        ],200);
        return response()->json([
            "msg"=>"Ocurrio un error al restaurar",
            "data"=> $persona,
            "status"=>500,
        ],500);
    }

    public function autosPorPersona($id)
    {
        // Obtener la persona por su ID con el WITH hace que traiga también los datos de sus carros
        $persona = Persona::with('autos')->find($id);

        if (!$persona) {
            return response()->json([
            "msg" => "La persona no existe",
            "status" => 404,
            ], 404);
        }

        // Obtener los autos de la persona
        $autos = $persona->autos();

        // Retornar una respuesta JSON con los autos de la persona
        return response()->json([
            "persona" => $persona,
            "autos" => $autos,
            "status" => 200,
        ], 200);
    }
}
