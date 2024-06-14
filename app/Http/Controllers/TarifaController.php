<?php

namespace App\Http\Controllers;

use App\Models\Tarifa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\TarifaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class TarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
{
    $sortableColumns = ['id', 'name', 'price', 'num_clases'];
    $sortColumn = $request->get('sort_by', 'id');
    $sortDirection = $request->get('sort_direction', 'asc');

    // Verificar si la columna de ordenación es válida
    if (!in_array($sortColumn, $sortableColumns)) {
        $sortColumn = 'id'; // Predeterminado a 'id' si la columna no es válida
    }

    // Aplicar filtros de búsqueda
    $query = Tarifa::query();
    
    if ($request->filled('search_name')) {
        $query->where('name', 'like', '%' . $request->search_name . '%');
    }

    if ($request->filled('search_price')) {
        $query->where('price', $request->search_price);
    }

    if ($request->filled('search_num_clases')) {
        $query->where('num_clases', $request->search_num_clases);
    }

    // Aplicar ordenación
    $query->orderBy($sortColumn, $sortDirection);

    // Obtener las tarifas paginadas
    $tarifas = $query->paginate();

    return view('tarifa.index', compact('tarifas', 'sortColumn', 'sortDirection'))
        ->with('i', ($request->input('page', 1) - 1) * $tarifas->perPage());
}


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $tarifa = new Tarifa();

        return view('tarifa.create', compact('tarifa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TarifaRequest $request): RedirectResponse
    {
        Tarifa::create($request->validated());

        return Redirect::route('tarifa.index')
            ->with('success', 'Tarifa creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $tarifa = Tarifa::find($id);

        return view('tarifa.show', compact('tarifa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $tarifa = Tarifa::find($id);

        return view('tarifa.edit', compact('tarifa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TarifaRequest $request, Tarifa $tarifa): RedirectResponse
    {
        $tarifa->update($request->validated());

        return Redirect::route('tarifa.index')
            ->with('success', 'Tarifa actualizada correctamente');
    }

    public function destroy($id)
{
    $tarifa = Tarifa::findOrFail($id);

    // Verificar si hay usuarios asociados a esta tarifa
    $usuariosConTarifa = User::where('id_tarifa', $id)->exists();

    if ($usuariosConTarifa) {
        // Si hay usuarios con esta tarifa, mostrar un mensaje de error
        return redirect()->route('tarifa.index')->with('error', 'Esta tarifa está asociada a usuarios.');
    } else {
        // Si no hay usuarios con esta tarifa, eliminarla directamente
        $tarifa->delete();
        return redirect()->route('tarifa.index')->with('success', 'Tarifa eliminada correctamente.');
    }
}

}