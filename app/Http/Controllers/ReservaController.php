<?php
namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Clase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\ReservaRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Http\Controllers\ClaseController;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sortableColumns = ['id', 'fecha_hora', 'dni', 'name'];
        $sortColumn = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');

        // Verificar si la columna de ordenación es válida
        if (!in_array($sortColumn, $sortableColumns)) {
            $sortColumn = 'id'; // Predeterminado a 'id' si la columna no es válida
        }

        // Aplicar búsqueda y ordenación
        $query = Reserva::query();

        if ($request->filled('search_dni')) {
            $query->whereHas('usuario', function ($q) use ($request) {
                $q->where('dni', 'like', '%' . $request->search_dni . '%');
            });
        }

        if ($request->filled('search_nombre')) {
            $query->whereHas('usuario', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search_nombre . '%')
                  ->orWhere('apellido_1', 'like', '%' . $request->search_nombre . '%')
                  ->orWhere('apellido_2', 'like', '%' . $request->search_nombre . '%');
            });
        }

        if ($request->filled('search_clase')) {
            $query->where('id_clase', $request->search_clase);
        }

        // Aplicar ordenación
        if ($sortColumn == 'fecha_hora') {
            $query->orderByClaseFechaHora($sortDirection);
        } else if ($sortColumn == 'dni' || $sortColumn == 'nombre') {
            $query->orderByUsuario($sortColumn, $sortDirection);
        } else {
            $query->orderBy($sortColumn, $sortDirection);
        }

        // Obtener las reservas paginadas
        $reservas = $query->with(['clase', 'usuario'])->paginate();

        // Obtener todas las clases para los desplegables
        $clases = Clase::all();

        // Pasar los datos a la vista
        return view('reserva.index', compact('reservas', 'sortColumn', 'sortDirection', 'clases'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $reserva = new Reserva();

        return view('reserva.create', compact('reserva'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservaRequest $request): RedirectResponse
    {
        Reserva::create($request->validated());

        return Redirect::route('reserva.index')
            ->with('success', 'Reserva created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $reserva = Reserva::findOrFail($id);
    
        // Eager loading para evitar consultas adicionales
        $reserva->load('clase.aula', 'usuario');
    
        return view('reserva.show', compact('reserva'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $reserva = Reserva::findOrFail($id);

        return view('reserva.edit', compact('reserva'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservaRequest $request, Reserva $reserva): RedirectResponse
    {
        $reserva->update($request->validated());

        return Redirect::route('reserva.index')
            ->with('success', 'Reserva actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
{
    $reserva = Reserva::findOrFail($id);

    // Crear una instancia de ClaseController
    $claseController = new ClaseController();

    // Llamar al método cancelarReserva del ClaseController
    $claseController->cancelarReservaAdmin($reserva->id_clase, $reserva->id_usuario);

    // Eliminar la reserva
    $reserva->delete();

    return redirect()->route('reserva.index')
        ->with('success', 'Reserva eliminada y clase devuelta al usuario.');
}


}