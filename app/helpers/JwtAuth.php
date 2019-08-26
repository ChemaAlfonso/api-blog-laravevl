<?php

// Le asignamos un namespace
namespace App\Helpers;

// Libreria JWT
use Firebase\JWT\JWT;

// BBDD laravel
use Illuminate\Support\Facades\DB;

// Modelo de usuario
use App\User;

class JwtAuth{

    public $key;

    public function __construct(){
        $this->key = 'clave_super_secreta';
    }

    public function singup( $email, $password, $getToken = null ){
        // Comprobar si existe usuario
        // $user = Modelo::metodoDelOrmDeseado(['nombreEnDb' => $variableAcomparar]); añadir ->first() para solo el primer objeto.
        $user = User::where([
            'email'    => $email,
            'password' => $password
        ])->first();

        // Comprobar credenciales
        $singup = false;
        if ( is_object( $user ) ){
            $singup = true;
        }

        // Generar token con datos de usuario identificado
        if ( $singup ){
            $token = array(
                'sub'     => $user->id,
                'email'   => $user->email,
                'name'    => $user->name,
                'surname' => $user->surname,
                'iat'     => time(),
                'exp'     => time() + (7 * 24 * 60 * 60)
            );

            // $jwt = JWT::encode($token, ClavceUnicaDelBackend, 'AlgoritmoUtilizado')
            $jwt     = JWT::encode($token, $this->key, 'HS256');
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
            
            // Devolver datos decodificados o el token segun parámetro
            if ( is_null($getToken) ){
                $data = $jwt;
            } else {
                $data = $decoded;
            }

        } else {
            $data = array(
                'status'  => 'error',
                'message' => 'Login incorrecto'
            );           
        }

        return $data;

    }
}