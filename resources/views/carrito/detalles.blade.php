@extends('layouts.app')

@section('content')
<div class ="container">
  @if(isset($carrito))
    @foreach($carrito as $producto)
        @foreach($producto as $detalles)   
         
        <div class="card mb-4">
          <div class="card-body p-4">

            <div class="row align-items-center">
              
              <div class="col-md-3 d-flex justify-content-center">
                <div>
                  <p class="small text-muted mb-4 pb-2">Nombre</p>
                  <p class="lead fw-normal mb-0">{{$detalles['nombre']}}</p>
                  </p>
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="small text-muted mb-4 pb-2">Cantidad</p>
                  <p class="lead fw-normal mb-0">{{$detalles['cantidad']}}</p>
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="small text-muted mb-4 pb-2">Precio</p>
                  <p class="lead fw-normal mb-0">{{$detalles['precio']}}</p>
                </div>
              </div>
              <div class="col-md-2 d-flex justify-content-center">
                <div>
                  <p class="small text-muted mb-4 pb-2">Total</p>
                  <p class="lead fw-normal mb-0">{{$detalles['precio'] * $detalles['cantidad'] }}</p>
                </div>
              </div>
            </div>

          </div>
        </div>
        @endforeach
    @endforeach
    <div class="card mb-5">
          <div class="card-body p-4">

            <div class="float-end">
              <p class="mb-0 me-5 d-flex align-items-center">
                <span class="small text-muted me-2">Total sin Impuestos: </span><span class="lead fw-normal">{{$total*0.81}}</span>                
                <p class="mb-0 me-5 d-flex align-items-center">
                  <span class="small text-muted me-2">Impuestos:</span> <span class="lead fw-normal">{{$total*0.19}}</span>           
                <p class="mb-0 me-5 d-flex align-items-center">
                <span class="small text-muted me-2">Total:</span> <span class="lead fw-normal">{{$total}}</span>                
            </div>

          </div>
        </div>
        
    <a href="{{route('pedido.toPayment')}}"><button class="btn btn-primary"> Hacer Pedido</button></a>
  @else
  
  @endif
  </div>
@endsection