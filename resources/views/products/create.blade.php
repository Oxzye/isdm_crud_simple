@extends('layouts.app')

@section('title', 'Crear producto')

@section('content')
    <h1>Crear un nuevo producto</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
    <form action="{{ route('products.store') }}" method="post" novalidate>
    @csrf

        <label for="name">Nombre:</label>
        <input type="text" name="name" value="{{ old('name') }}">
<br>
        <label for="description">Descripcion:</label> <br>
        <textarea name="description" id="" cols="30" rows="10" value="{{ old('description') }}"></textarea>
<br>
        <label for="unit_price">unit_price:</label>
        <input type="number" name="unit_price" value="{{ old('unit_price') }}">
<br>
        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="{{ old('stock') }}">
<br>
        <button type="submit">Guardar producto</button>
        <a href="{{route('products.index') }}">Cancelar</a>
       
       
    </form>

@endsection
