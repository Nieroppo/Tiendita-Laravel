<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');        
    }
    public function producto(){
        return $this->belongsTo('App\Models\Producto','producto_id');        
    }
}
