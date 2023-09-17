@extends('layouts.app')

@section('title','Listado de Productos')
    
@section('content')
    @if ($products->count())
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9 mx-auto">
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status')}}
                    </div>
                @endif

                <a href="{{ route('products.create') }}" class="btn border border-2">Agregar</a>
            
                <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio unitario</th>
                        <th>Stcok</th>
                        <th>Ultima actualizacion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>${{$product->unit_price}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->updated_at}}</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}">Ver</a>
                                <a href="{{ route('products.edit', $product->id) }}">Editar</a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                @csrf @method('DELETE')
                                <button type="submit">Eliminar</button>
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
            </div>
        </div>
    </div>
    @else
        <h4>¡No hay productos cargados!</h4>  
    @endif
@endsection