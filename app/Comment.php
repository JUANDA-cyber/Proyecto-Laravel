<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    
    //relacion de muchos a uno
    public function user(){
        return $this->belongsto('App\User', 'user_id'); 
    }

    //relacion de muchos a uno
    public function image(){
        return $this->belongsto('App\Image', 'image_id'); 
    }
}

