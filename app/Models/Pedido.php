<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedidos';
    
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');        
    }
    public function repartidor(){
        return $this->belongsTo('App\Models\Repartiodor','repartidor_id');        
    }
    public function pago(){
        return $this->hasOne('App\Models\Pago','pago_id');        
    }
}
