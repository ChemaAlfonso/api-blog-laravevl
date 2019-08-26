<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Incluye el usuario
use App\User;

class UserController extends Controller
{
    /*
    public function pruebas(Request $request){
        return "Función pruebas de UserController";
    }
    */
    public function register(Request $request){
        // Recoger datos del usuario por post
        // $json = $request->input('name del input', valor si no encuentra el input);
        $json = $request->input('json', null);
        $params = json_decode($json);

        // Array de parametros (si se necesita)
        // $params_array = json_decode($json, true si array);
        $params_array = json_decode($json, true);

        // Limpiar datos
        $params_array = array_map('trim', $params_array);

        // Validar datos
        // Se usa la clase validator
        $validate = \Validator::make($params_array, [
            'name'      => 'required|alpha',
            'surname'   => 'required|alpha',
            'email'     => 'required|email|unique:users', // unico:tablaObjetivo
            'password'  => 'required',
        ]);

        if ($validate->fails()){            
            $data = array(
                'status'  => 'error',
                'code'    => 404,
                'message' => 'El usuario no se ha creado correctamente',
                'errors'  => $validate->errors()
            );
            
            return response()->json($data, $data['code']);

        } else {

            // Cifrar contraseña
            $pass = hash('sha256', $params->password);  
            //$pass = password_hash($params->password, PASSWORD_BCRYPT, ['cost' => 4]);            
            
            // Crear usuario
            $user = new User();
            $user->name = $params_array['name'];
            $user->surname = $params_array['surname'];
            $user->email = $params_array['email'];
            $user->password = $pass;
            $user->role = 'USER_ROLE';
            
            // Guardar el usuario
            $user->save();

            $data = array(
                'status'  => 'success',
                'code'    => 200,
                'message' => 'El usuario se ha creado correctamente',
                'errors'  => null,
                'user'    => $user
            );

            return response()->json($data, $data['code']);

        }
    }

    public function login(Request $request){

        // Se llama al alias \JwtAuth()
        $jwtAuth = new \JwtAuth();

        $email = "contacto@tempuscode.com"; 
        $password = "chema";
        //$password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]); 
        $password = hash('sha256', $password); 
        
        return response()->json($jwtAuth->singup($email, $password), 200);
    }
}
