<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {

        $products = Product::paginate(5);

        return view('products.index', compact('products'));
    }

    public function create () {
        return view('products.create');
    }

    public function store(Request $request) {

        // Define las reglas de validación
        $rules = [
            'name' => 'required|string|max:20',
            'description' => 'nullable|string|max:255',
            'unit_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
        ];

        // Define los mensajes de error personalizados (opcional)
        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe tener más de 20 caracteres.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe tener más de 255 caracteres.',
            'unit_price.required' => 'El precio unitario es obligatorio.',
            'unit_price.numeric' => 'El precio unitario debe ser un número.',
            'unit_price.min' => 'El precio unitario debe ser mayor que 0.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser mayor a 0.',
            'stock.required' => 'El stock es requirido',
        ];

        // Valida los datos del formulario
        $request->validate($rules, $messages);

        //Guardado de datos
        Product::create($request->all());

        //Redireccion con un mensaje flash de sesion
        return redirect()->route('products.index')->with('status', 'producto creado exitosamente!');
    }

    public function edit($id) {
        $product = Product::findOrFail($id);
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, $id) {
        //Busqueda del producto
        $product = Product::findOrFail($id);

        // Define las reglas de validación
        $rules = [
            'name' => 'required|string|max:20',
            'description' => 'nullable|string|max:255',
            'unit_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
        ];

        // Define los mensajes de error personalizados (opcional)
        $messages = [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no debe tener más de 20 caracteres.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
            'description.max' => 'La descripción no debe tener más de 255 caracteres.',
            'unit_price.required' => 'El precio unitario es obligatorio.',
            'unit_price.numeric' => 'El precio unitario debe ser un número.',
            'unit_price.min' => 'El precio unitario debe ser mayor que 0.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock debe ser mayor a 0.',
            'stock.required' => 'El stock es requirido',
        ];

        // Valida los datos del formulario
        $request->validate($rules, $messages);

        //Actualizacion del producto
        $product->update($request->all());

        //redireccion
        return redirect()->route('products.index')->with('status', 'Producto actualizado correctamente!');
    }

    public function destroy($id) {
        //Busqueda de producto
        $product = Product::findOrFail($id);

        //Eliminacion del producto
        $product->delete();

        //Redireccion con un mensaje
        return redirect()->route('products.index')->with('status', 'Producto eliminado correctamente!');
    }

    public function show($id) {
        $product = Product::findOrFail($id);
        return view('products.show', ['product' => $product]);
    }
}
