@extends('layouts.app')

@section('content')

<div class="container">
 

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Pago</span>
            
            
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Sin impuestos</h6>
                
              </div>
              <span class="text-muted">${{$total*0.81}}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Impuestos</h6>
                
              </div>
              <span class="text-muted">${{$total*0.19}}</span>
            </li>
            
            <li class="list-group-item d-flex justify-content-between">
              <span>Total</span>
              <strong>${{$total}}</strong>
            </li>
          </ul>

          
        </div>
        <div class="col-md-8 order-md-1 ">
          <h4 class="mb-3">Dirección de Envio</h4>
          <form class="needs-validation" novalidate="" action ="{{route('pedido.pay')}}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">Nombre</label>
                <input type="text" disabled class="form-control" id="firstName" placeholder="" value="{{Auth::user()->nombre}}" required="">
                
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Apellido</label>
                <input type="text" disabled class="form-control" id="lastName" placeholder="" value="{{Auth::user()->apellido}}" required="">
                
              </div>
            </div>

            

            <div class="mb-3">
              <label for="email">Email </label>
              <input type="email" disabled class="form-control" id="email"  value="{{Auth::user()->email}}" required="">
              
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" disabled class="form-control" id="address" placeholder="" value="{{Auth::user()->direccion}} {{Auth::user()->comuna}} {{Auth::user()->region}}" required="">
              
            </div> 
                     
            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="repartidor">Repartidor</label>
                <select name="repartidor" class="custom-select d-block w-100" id="country" required="" >                
                    @foreach($repartidores as $repartidor)
                         <option value="{{$repartidor->id}}">{{$repartidor->nombre}}</option>
                    @endforeach
                </select>
              </div>
            </div>
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="" value="Credito">
                <label class="custom-control-label" for="credito" >Credito</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="" value="Transferencia">
                <label class="custom-control-label" for="transferencia" >Transferencia</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="" value="Webpay">
                <label class="custom-control-label" for="webpay">Webpay</label>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <input type="hidden" name="impuestos" value="{{$total*0.19}}" >
            <input type="hidden" name="sinImpuestos" value="{{$total*0.81}}" >
            <input type="hidden" name="priceTotal" value="{{$total}}" >
            <input type="hidden" name="descuento" value="0" >
            <button class="btn btn-primary btn-lg btn-block" type="submit">Pagar</button>
          </form>
        </div>
      </div>
    </div>
@endsection