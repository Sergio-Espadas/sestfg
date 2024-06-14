<?php

namespace App\Http\Controllers;

use App\Models\Aula;
use App\Models\Clase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\AulaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AulaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortableColumns = ['id', 'nombre', 'capacidad'];
        $sortColumn = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
    
        // Verificar si la columna de ordenación es válida
        if (!in_array($sortColumn, $sortableColumns)) {
            $sortColumn = 'id'; // Predeterminado a 'id' si la columna no es válida
        }
    
        // Obtener los parámetros de búsqueda
        $searchNombre = $request->input('search_nombre');
        $searchCapacidad = $request->input('search_capacidad');
    
        // Consulta base
        $query = Aula::query();
    
        // Aplicar búsqueda si hay parámetros
        if ($searchNombre) {
            $query->where('nombre', 'like', "%{$searchNombre}%");
        }
    
        if ($searchCapacidad) {
            $query->where('capacidad', '=', $searchCapacidad);
        }
    
        // Ordenar y paginar los resultados
        $aulas = $query->orderBy($sortColumn, $sortDirection)->paginate();
    
        return view('aula.index', compact('aulas', 'sortColumn', 'sortDirection'))
            ->with('i', ($request->input('page', 1) - 1) * $aulas->perPage());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $aula = new Aula();

        return view('aula.create', compact('aula'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AulaRequest $request): RedirectResponse
{
    $aula = new Aula([
        'nombre' => $request->input('aulaNombre'),
        'capacidad' => $request->input('aulaCapacidad'),
    ]);

    $aula->save();

    return Redirect::route('aula.index')->with('success', 'Aula creada correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $aula = Aula::findOrFail($id);

        return view('aula.show', compact('aula'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $aula = Aula::findOrFail($id);

        return view('aula.edit', compact('aula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AulaRequest $request, $id): RedirectResponse
{
    $aula = Aula::findOrFail($id);

    $aula->update([
        'nombre' => $request->input('aulaNombre'),
        'capacidad' => $request->input('aulaCapacidad'),
    ]);

    return Redirect::route('aula.index')->with('success', 'Aula actualizada correctamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        // Buscar el aula
        $aula = Aula::findOrFail($id);

        // Verificar si el aula está asociada a alguna clase
        $clasesRelacionadas = Clase::where('id_aula', $id)->count();

        if ($clasesRelacionadas > 0) {
            return redirect()->route('aula.index')
                ->with('error', 'Aún hay clases relacionadas con este aula');
        }

        // Si no está asociado, eliminar el aula
        $aula->delete();

        return redirect()->route('aula.index')
            ->with('success', 'Aula eliminada correctamente');
    }
}