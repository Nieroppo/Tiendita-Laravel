<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    public function proveedor(){
        return $this->belongsTo('App\Models\Proveedor','proveedor_id');        
    }
    public function comentarios(){
        return $this->hasMany('App\Models\Comentario');
    } 

    public function categorias(){
        return $this->belongsToMany('App\Models\Categoria');
    }

    public function getPromedioAttribute(){
        
        $producto_id = intval($this->id);
        $promedio = Comentario::where('producto_id', $producto_id)
                                ->avg('calificacion');
        $promedio = round($promedio, 1);
        return $promedio;
    }
}
