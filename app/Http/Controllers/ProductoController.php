<?php

namespace App\Http\Controllers;
use App\Models\producto;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use  Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    //
    public function getImagen($filename = null){
        $file = Storage::disk('producto')->get("No-Image-Placeholder.svg.png");
       
        if(!is_null($filename)){
            $file = Storage::disk('producto')->get($filename);
        }
        return new Response($file, 200);
    }
    public function getProducto($id){
        $producto = Producto::find($id);
        $promedio = $producto->promedio;
        
        return view('productos.detalles',[
            'producto' => $producto,
            'promedio' => $promedio
        ]);
    }
}
