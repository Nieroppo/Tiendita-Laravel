@extends('layouts.app')

@section('content')
<div class="container">
    <div class="producto row justify-content-center">
        <div class="producto col-4 left">
            <img src="{{route('producto.imagen',['filename' => $producto->imagen])}}" />
        </div>
        <div class="col-4 right">
            <div class = "info">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>{{$producto->nombre}}</td>
                        </tr>
                        <tr>
                            <td>{{$producto->descripcion}}</td>            
                        </tr>
                        <tr>
                            <td>${{$producto->precio}}</td>
                        </tr>
                        <tr>
                            <td>Stock: {{$producto->stock}}</td>
                        </tr>
                        
                        <tr>
                            <td>
                                {{$promedio}}
                              <i class="fa fa-star text-warning"> <i class="fa fa-check-circle-o check-icon"></i> </i>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @if($producto->stock > 0)
                    <form action="{{route('pedido.agregarCarrito')}}" method="POST">
                        @csrf
                        <input type="hidden" name="nombre" value="{{$producto->nombre}}"/>
                        <input type="hidden" name="precio" value="{{$producto->precio}}"/>
                        <input type="hidden" name="producto_id" value="{{$producto->id}}"/>
                        <div class="cantidad"> <span>Cantidad: </span> <input id="cantidad" type="text" name="cantidad" pattern="[0-9]*" value="1"></div>
                        <button class="btn btn-success" type="submit">Agregar al carrito</button>
                    </form>
                @endif
        </div>
    </div>
</div>
        <h2> Comentarios ({{count($producto->comentarios)}})</h2>
        @auth
            <div class="comentario box">        
                <form  action="{{route('comentarios.save')}}" method="POST">
                    @csrf
                    <div class="calificacion"> <input type="radio" name="calificacion" value="5" id="5"><label for="5">☆</label> <input type="radio" name="calificacion" value="4" id="4"><label for="4">☆</label> <input type="radio" name="calificacion" value="3" id="3"><label for="3">☆</label> <input type="radio" name="calificacion" value="2" id="2"><label for="2">☆</label> <input type="radio" name="calificacion" value="1" id="1"><label for="1">☆</label> </div>
                    <input type="hidden" name="producto_id" value="{{$producto->id}}"/>
                    <textarea class="form-control" name="descripcion" required></textarea>
                    <button type="submit" class="btn btn-success">Enviar</button>
                </form>
            </div>
        @endauth
        <div class="comentarios container">
            @foreach($producto->comentarios as $comentario)
                <div class="comentario">
                    <span class="nombre">{{$comentario->user->nombre}}</span>
                    <span class="text-muted"> 
                        | {{$comentario->calificacion}}
                        <i class="fa fa-star text-warning"> <i class="fa fa-check-circle-o check-icon"></i> </i>
                    </span>
                    <span class="fecha text-muted">| {{\FormatTime::LongTimeFilter($comentario->created_at)}}</span>
                    
                    <p> {{$comentario->descripcion}}</p>
                    
                </div>
            @endforeach
        </div>
</div>
@endsection
