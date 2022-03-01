<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Producto;

class Carrito extends Model
{
    use HasFactory;
    public $carrito  =array();

}
