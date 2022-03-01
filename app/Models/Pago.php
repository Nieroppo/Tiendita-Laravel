<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    public function user(){
        return $this->belongsTo('App\Models\User','id_usuario');        
    }
    public function pedido(){
        return $this->belongsTo('App\Models\Pedido','pedido_id');        
    }
}
