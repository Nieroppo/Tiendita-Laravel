@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row">
      <div class="col-md-6 mx-auto mt-5">
         <div class="payment">
            <div class="payment_header">
               <div class="check"><i class="fa fa-check" aria-hidden="true"></i></div>
            </div>
            <div class="content">
               <h1>Pago Realizado !</h1>
               <p>el pedido llegará dentro de un par de dias</p>
               <a href="/tiendita/">ir al inicio</a>
            </div>
            
         </div>
      </div>
   </div>
</div>
@endsection