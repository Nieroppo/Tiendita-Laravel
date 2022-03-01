<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Comentario;
use Illuminate\Support\Facades\DB;

class ComentarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        $user = \Auth::user();
        $producto_id = $request->producto_id;
        $calificacion = $request->calificacion;
        $descripcion = $request->descripcion;
        
        $comenterio = new Comentario();
        $comenterio->user_id = $user->id;
        $comenterio->producto_id = $producto_id;
        $comenterio->descripcion = $descripcion;
        $comenterio->calificacion =$calificacion;
        $comenterio->save();

        return redirect()->route('producto.detalles', ['id' => $producto_id]);
    }

   
}
