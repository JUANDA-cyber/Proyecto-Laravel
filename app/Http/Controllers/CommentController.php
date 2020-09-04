<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function save(Request $request){

        // validacion
        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);

        // recoge los datos
        $user = \Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        // Asigno valores a mi nuevo objeto a guardar
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        // Guardar en la Bd
        $comment->save();

        // Redireccion 
        return redirect()->route('image.detail', ['id' => $image_id])
                         ->with([
                             'message' => 'Has publicado tu comentario Correctamente!!'
                         ]);        
    }

    public function delete($id){
        // Consegir datos del usuarios logueado
        $user = \Auth::user();

        // Conseguir objeto del comentario
        $comment = Comment::find($id);

        // Comprobar si es el dueño del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();

            return redirect()->route('image.detail', ['id' => $comment->image->id])
                         ->with([
                             'message' => 'Has eliminado el comentario!!'
                         ]); 
        }else{

            return redirect()->route('image.detail', ['id' => $comment->image->id])
                         ->with([
                             'message' => 'NO se ha eliminado el comentario!!'
                         ]); 
        }



    }

}
