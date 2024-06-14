<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Models\Clase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TrabajoRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sortBy = $request->input('sort_by', 'id');
        $sortDirection = $request->input('sort_direction', 'asc');
        $searchNombre = $request->input('search_nombre', '');
    
        $query = Trabajo::query();
    
        if ($searchNombre) {
            $query->where('nombre', 'like', "%{$searchNombre}%");
        }
    
        $trabajos = $query->orderBy($sortBy, $sortDirection)->paginate();
    
        return view('trabajo.index', compact('trabajos', 'sortBy', 'sortDirection', 'searchNombre'))
            ->with('i', ($request->input('page', 1) - 1) * $trabajos->perPage());
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $trabajo = new Trabajo();

        return view('trabajo.create', compact('trabajo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TrabajoRequest $request): RedirectResponse
    {
        Trabajo::create($request->validated());

        return Redirect::route('trabajo.index')
            ->with('success', 'Trabajo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $trabajo = Trabajo::find($id);

        return view('trabajo.show', compact('trabajo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $trabajo = Trabajo::find($id);

        return view('trabajo.edit', compact('trabajo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TrabajoRequest $request, Trabajo $trabajo): RedirectResponse
    {
        $trabajo->update($request->validated());

        return Redirect::route('trabajo.index')
            ->with('success', 'Trabajo actualizado correctamente');
    }

    public function destroy($id)
    {
        // Buscar el trabajo
        $trabajo = Trabajo::findOrFail($id);

        // Verificar si el trabajo está asociado a alguna clase
        $clasesRelacionadas = Clase::where('id_trabajo', $id)->count();

        if ($clasesRelacionadas > 0) {
            return redirect()->route('trabajo.index')
                             ->with('error', 'Aún hay clases relacionadas con este tipo de trabajo');
        }

        // Si no está asociado, eliminar el trabajo
        $trabajo->delete();

        return redirect()->route('trabajo.index')
                         ->with('success', 'Trabajo eliminado correctamente');
    }
}