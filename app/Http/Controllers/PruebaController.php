<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PruebaController extends Controller
{

    public function index(){
        $titulo = 'Animales';
        $animales = ['perro', 'gato', 'tigre'];

        return view('pruebas.index', array(
            'titulo'   => $titulo,
            'animales' => $animales
        ));
    }

    public function testOrm(){
        
        $posts = Post::all();
/*
        foreach ($posts as $post) {
            echo '<h1>' . $post->title . '</h1>';
            echo "<span>Autor: {$post->user->name} - Categoria: {$post->category->name} </span>";
            echo '<p>' . $post->content . '</p><hr>';
        }   
        
        echo '<br><hr><br>';
*/
        $categories = Category::all();
        foreach ($categories as $category) {
            echo '<h1>' . $category->name . '</h1>';

            foreach ($category->posts as $post) {
                echo '<h1>' . $post->title . '</h1>';
                echo "<span>Autor: {$post->user->name} - Categoria: {$post->category->name} </span>";
                echo '<p>' . $post->content . '</p><hr>';
            }  
        }
        
        die();
    }
}
