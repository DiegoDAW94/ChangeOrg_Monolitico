<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class AdminCategoriasController extends Controller
{
    /**
     * Mostrar todas las categorías.
     */
    public function index()
    {
        $categorias = Categoria::paginate(10); // Cambia 10 por el número deseado de resultados por página
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Mostrar una categoría específica.
     */
    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.show', compact('categoria'));
    }


}
