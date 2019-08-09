<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba/{nombre}', function($nombre) {
    $texto = "Texto desde una ruta";
    //return '<h1>' . $texto . ' ' . $nombre .'</h1>';
    return view('pruebas', array(
        'texto' => $texto
    ));
});

Route::get('/pruebas/animales', 'pruebaController@index');

Route::get('/testOrm', 'pruebaController@testOrm');
