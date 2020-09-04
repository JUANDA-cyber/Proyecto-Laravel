<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    //relacion one to many
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id','DESC');
    }
    //relacion one to many
    public function likes(){
        return $this->hasMany('App\Like');
    }

    //relacion de muchos a uno
    public function user(){
        return $this->belongsto('App\User', 'user_id'); 
    }
}
