<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all()->map(function ($p) {
            $p->imagen_url = $p->imagen
                ? asset('storage/' . $p->imagen)
                : null;
            return $p;
        });

        return response()->json(
            $productos,
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'imagen' =>
                'nullable|image|mimes:jpg,png,webp,jpeg|max:2048'
        ]);

        $data = $request->except('imagen');

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request
                ->file('imagen')
                ->store('productos', 'public');
        }

        $producto = Producto::create($data);

        return response()->json(
            $producto,
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $producto->imagen_url = $producto->imagen
            ? asset('storage/' . $producto->imagen)
            : null;

        return response()->json(
            $producto,
            200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $data = $request->except('imagen');
        
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request
                ->file('imagen')
                ->store('productos', 'public');
        }

        $producto->update($data);

        $producto->imagen_url = $producto->imagen
            ? asset('storage/' . $producto->imagen)
            : null;

        return response()->json(
            $producto,
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->json(
            null,
            204
        );
    }
}
