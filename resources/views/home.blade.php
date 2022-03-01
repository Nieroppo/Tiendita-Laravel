@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            @foreach($productos as $producto)
             <div class="card">
                <a href="{{route('producto.detalles',['id' => $producto->id])}}">
                <div class="bd-placeholder-img card-img-top">
                    <img src="{{route('producto.imagen',['filename' => $producto->imagen])}}"/>
                </div>
                <div class="card-body">
                    <h5>{{$producto->nombre}}</h5>
                    <small class="text-muted">${{$producto->precio}}</small>
                </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
