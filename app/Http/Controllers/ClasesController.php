<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Support\Facades\Auth;

class ClasesController extends Controller
{
    /**
     * Show the classes.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clases()
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('index');
        }

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener todas las clases ordenadas por fecha y hora
        $clases = Clase::orderBy('fecha')->orderBy('hora')->paginate();

        // Pasar las clases y el usuario a la vista
        return view('clases', compact('clases', 'user'));
    }
}