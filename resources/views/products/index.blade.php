@extends('layouts.app')

@section('title','Listado de Productos')
    
@section('content')

    <a href="{{ route('products.create') }}" class="btn border border-2 border-light">Agregar</a>

    @if ($products->count())
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 mx-auto">
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status')}}
                    </div>
                @endif

                
            
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
                                <div class="row">
                                        <div class="col-lg-4 ">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-success">
                                            <i class="fa-solid fa-book-open fa-lg"></i><br>Mostrar
                                        </a>  
                                        </div>
                                            
                                        <div class="col-lg-4">
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">
                                            <i class="fa-solid fa-pen-to-square fa-lg"></i><br>Editar
                                            </a>
                                        </div>

                                        <div class="col-lg-4">
                                            <form action="{{ route('products.destroy', $product->id) }}" method="post" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                            <i class="fa-sharp fa-solid fa-trash-can fa-lg"></i><br>Eliminar
                                            </button>
                                            </form>
                                        </div>
                                </div>                                                       
                     
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
