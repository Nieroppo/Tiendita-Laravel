<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Date;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;
use App\Models\Repartidor;
use Carbon\Carbon;

use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Pago;
class PedidoController extends Controller
{

    public function agregarCarrito(Request $request){

        $cantidad = intval($request->cantidad);
        $producto_id = intval($request->producto_id);
        $precio = intval($request->precio);
        $nombre = $request->nombre;

        if(Session::has('carrito')){
            $productos = Session::get('carrito',[]);
            $validator =false;
            foreach($productos as &$producto){
               if(isset($producto[$producto_id]['cantidad'])){
                $producto[$producto_id]['cantidad'] = $producto[$producto_id]['cantidad'] +$cantidad;
                $validator = true;
                }
            }
            if($validator){
                Session::put('carrito', $productos);
            }   
            if(!$validator){
                Session::push('carrito', [
                    $producto_id =>[
                        'producto_id' => $producto_id,
                        'cantidad'  => $cantidad,
                        'nombre'    => $nombre,
                        'precio'    => $precio
                    ]
                    
                ]);    
            }
        }else{
            Session::push('carrito', [
                $producto_id =>[
                    'producto_id' => $producto_id,
                    'cantidad'  => $cantidad,
                    'nombre'    => $nombre,
                    'precio'    => $precio
                ]
                
            ]);
        }
        return redirect()->route('producto.detalles', ['id' => $producto_id]);
        
        
    }
    public function totalCarrito(){
        $carrito = Session::get('carrito');
        $total =0;
        if(isset($carrito)){
            foreach($carrito as $producto){
                foreach($producto as $detalles){
                    $total = $total+ ($detalles['precio']*$detalles['cantidad']);
                }
            }
        }
        return $total;        
    } 
    public function getCarrito(){
        $carrito = Session::get('carrito');
        $total = $this->totalCarrito();  
        
       return view('carrito.detalles',[
            'carrito' => $carrito,
            'total' => $total
        ]); 
    }
   
    public function toPayment(){
        
        $user = \Auth::user();
        if(!isset($user)){
            return redirect()->route('login');
        }
        $total = $this->totalCarrito();
        $region = $user->region;
        $zona ="";
        if($region == "Arica y Parinacota" || $region == "Antofagasta" || $region =="Atacama" || $region == "Tarapaca" || $region == "Coquimbo"){
            $zona = "Norte";
        }
        if($region == "Valparaiso" || $region == "Metropolitana de Santiago" || $region =="O'Higgins" || $region == "Maule"){
            $zona = "Centro";
        }
        if($region == "Biobio" || $region == "Araucania" || $region =="los Rios" || $region == "los Lagos" || $region == "Aysen" || $region == "Magallanes"){
            $zona = "Sur";
        }
        $repartidores =Repartidor::where('zona',$zona)
                                    ->orwhere('zona',"nacional")
                                    ->get();
        
       return view('pedido.Payment',[
           'repartidores' => $repartidores,
            'total' =>$total
        ]);
    }
    public function pay(Request $request){
        $user = \Auth::user();
        if(!isset($user)){
            return redirect()->route('login');
        }
        $today = Carbon::now();
        $fecha_envio = $today->addDays(1);
        $fecha_envio = (new Carbon($fecha_envio))->format('Y-m-d');
        $fecha_entrega = $today->addDays(3);
        $fecha_entrega = (new Carbon($fecha_entrega))->format('Y-m-d');
        $user_id = $user->id;
        $repartidor_id = $request->repartidor;
        $monto_parcial = $request->sinImpuestos;
        $impuesto = $request->impuestos;
        $monto_total =$request->priceTotal;
        $descuentos =$request->descuento;
        $medio_pago = $request->paymentMethod;
        
        // userid repartidor id monto sin impuesto descuento impuesto monto_total fecha_envio fecha_entrega estado
        $pedido = new Pedido();
        $pedido->user_id = $user_id;
        $pedido->repartidor_id = $repartidor_id;
        $pedido->monto_parcial = $monto_parcial;
        $pedido->impuesto = $impuesto;
        $pedido->monto_total=$monto_total;
        $pedido->descuentos = $descuentos;
        $pedido->fecha_entrega = $fecha_entrega;
        $pedido->fecha_envio = $fecha_envio;
        $pedido->estado ="pagado";
        $pedido->save();

        $pedido_id = Pedido::max('id');

        $pago = new Pago();
        $pago->user_id = $user_id;
        $pago->pedido_id = $pedido_id;
        $pago->monto = $monto_parcial;
        $pago->impuesto = $impuesto;
        $pago->monto_total = $monto_total; 
        $pago->medio_pago = $medio_pago;    
        $pago->save();
        $pago_id = Pago::max('id');
        $curruentPedido = Pedido::find($pedido_id);
        $curruentPedido->pago_id = $pago_id;
        $curruentPedido->save();

        $carrito = Session::get('carrito');
        foreach($carrito as $productos){
            foreach($productos as $producto){
                DB::table('pedidos_productos')->insert(
                    array(
                        'pedido_id' => $pedido_id,
                        'producto_id' => $producto['producto_id'],
                        'cantidad' => $producto['cantidad']
                        )
                    );
                $currentProducto = Producto::find($producto['producto_id']);
                $currentProducto->stock = $currentProducto->stock - $producto['cantidad'];
                $currentProducto->save();

            }
        }
        $request->session()->forget('carrito');
        return redirect()->route('pedido.paymentsuccess');
    }
    public function paymentsuccess(){
        return view('pedido.paymentsuccess');
    }
}
