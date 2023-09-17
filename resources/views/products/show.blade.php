@extends('layouts.app')

@section('title', "Datos del producto")
    
@section('content')
    <h1> Ver producto #{{ $product->id }} </h1>

    ID: {{ $product->id }}    <br>
    Nombre: {{ $product->name}}   <br>
    Descripcion: {{ $product->description }} <br>
    Precio: ${{ $product->unit_price}} <br>
    Stock: {{ $product->stock}} <br>
    Ultima Actualizacion: {{ $product->updated_at}}  <br>

    <a href="{{route('products.index') }}">Regresar</a>
@endsection