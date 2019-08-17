<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function pruebas(Request $request){
        return "Función pruebas de UserController";
    }

    public function register(Request $request){

        // Recoger datos del usuario por post
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);
        var_dump($params_array);die();

        // Validar datos

        // Cifrar contraseña

        // Comprobar si existe el usuario

        // Crear usuario

        $data = array(
            'status'  => 'error',
            'code'    => 404,
            'message' => 'El usuario no se ha creado correctamente'
        );

        return response()->json($data, $data['code']);
    }

    public function login(Request $request){
        return "Función login de UserController";
    }
}
