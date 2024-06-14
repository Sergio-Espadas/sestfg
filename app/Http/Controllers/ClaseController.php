<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Trabajo;
use App\Models\Aula;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ClaseRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;


class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
{
    $sortableColumns = ['id', 'id_aula', 'id_trabajo', 'fecha', 'hora'];
    $sortColumn = $request->get('sort_by', 'fecha');
    $sortDirection = $request->get('sort_direction', 'asc');

    // Verificar si la columna de ordenación es válida
    if (!in_array($sortColumn, $sortableColumns)) {
        $sortColumn = 'fecha'; // Predeterminado a 'fecha' si la columna no es válida
    }

    // Obtener todas las clases para el desplegable
    $allClases = Clase::all();

    // Aplicar búsqueda y ordenación
    $query = Clase::with(['aula', 'trabajo'])
        ->when($request->input('search_aula'), function ($query, $aula) {
            $query->whereHas('aula', function ($q) use ($aula) {
                $q->where('nombre', 'like', "%{$aula}%");
            });
        })
        ->when($request->input('search_trabajo'), function ($query, $trabajo) {
            $query->whereHas('trabajo', function ($q) use ($trabajo) {
                $q->where('nombre', 'like', "%{$trabajo}%");
            });
        })
        ->when($request->input('search_fecha'), function ($query, $fecha) {
            $query->whereDate('fecha', $fecha);
        })
        ->when($request->input('search_hora'), function ($query, $hora) {
            $query->whereTime('hora', $hora);
        })
        ->when($request->input('search_clase'), function ($query, $claseId) {
            $query->where('id', $claseId);
        });

    // Ordenar las clases según la columna y dirección especificadas
    switch ($sortColumn) {
        case 'id_aula':
        case 'id_trabajo':
            $query->orderBy($sortColumn, $sortDirection);
            break;
        default:
            // Si la columna no es 'id_aula' o 'id_trabajo', se ordena por fecha y hora
            $query->orderBy($sortColumn, $sortDirection);
            break;
    }

    $clases = $query->paginate();

    return view('clase.index', compact('clases', 'allClases', 'sortColumn', 'sortDirection'))
        ->with('i', ($request->input('page', 1) - 1) * $clases->perPage());
}


    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aulas = Aula::all();
        $trabajos = Trabajo::all();
        return view('clase.create', compact('aulas', 'trabajos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_aula' => 'required',
            'id_trabajo' => 'required',
            'fecha' => 'required|date|after:today',
            'hora' => 'required',
        ], [
            'fecha.after' => 'La fecha debe ser posterior al día actual.'
        ]);

        // Guardar la clase si la validación es exitosa
        Clase::create($request->all());

        // Redireccionar con un mensaje de éxito
        return redirect()->route('clase.index')
                         ->with('success', 'Clase creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $clase = Clase::with(['aula', 'trabajo'])->findOrFail($id);
    return view('clase.show', compact('clase'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $clase = Clase::findOrFail($id);
        $aulas = Aula::all();
        $trabajos = Trabajo::all();
        return view('clase.edit', compact('clase', 'aulas', 'trabajos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_aula' => 'required|exists:aulas,id',
            'id_trabajo' => 'required|exists:trabajos,id',
            'fecha' => 'required|date',
            'hora' => 'required'
        ]);

        $clase = Clase::findOrFail($id);
        $clase->update($request->all());

        return redirect()->route('clase.index')
                         ->with('success', 'Clase actualizada correctamente.');
    }

    public function destroy($id)
    {
        // Buscar la clase
        $clase = Clase::findOrFail($id);

        // Verificar si la clase tiene reservas asociadas
        $reservasRelacionadas = Reserva::where('id_clase', $id)->count();

        if ($reservasRelacionadas > 0) {
            return redirect()->route('clase.index')
                             ->with('error', 'Aún hay reservas relacionadas con esta clase');
        }

        // Si no tiene reservas asociadas, eliminar la clase
        $clase->delete();

        return redirect()->route('clase.index')
                         ->with('success', 'Clase eliminada correctamente');
    }

    public function reservarClase($claseId)
{
    // Encuentra la clase por su ID y carga la relación 'aula'
    $clase = Clase::with('aula')->findOrFail($claseId);

    // Verificar si el usuario tiene tarifa asignada
    if (!Auth::user()->hasTarifa()) {
        return redirect()->route('clases')->with(['error' => 'Debe contactar con su filial para que le asignen una tarifa.', 'error_clase_id' => $claseId]);
    }

    // Verificar si el usuario tiene cupos disponibles
    if (!Auth::user()->hasCuposClase()) {
        return redirect()->route('clases')->with(['error' => 'Ya ha agotado todos los cupos de clase de su tarifa actual este mes.', 'error_clase_id' => $claseId]);
    }

    // Crea una reserva para la clase actual y el usuario autenticado
    Reserva::create([
        'id_clase' => $clase->id,
        'id_usuario' => Auth::id(), // ID del usuario autenticado
    ]);

    // Actualizar cupos_clases del usuario (restar 1)
    Auth::user()->decrement('cupos_clases');

    // Redirige con un mensaje de éxito y detalles de la clase reservada
    return redirect()->route('clases')->with('success', 'Clase reservada correctamente')->with('claseReservada', $clase);
}

    

    public function finClase($claseId)
{
    // Encuentra la reserva correspondiente al usuario autenticado y la clase específica
    $reservas = Reserva::where('id_clase', $claseId)->get();

    // Eliminar todas las reservas asociadas a la clase
    foreach ($reservas as $reserva) {
        // Actualizar cupos_clases del usuario (sumar 1)
        $usuario = User::find($reserva->id_usuario);
        if ($usuario) {
            $usuario->increment('cupos_clases');
        }

        // Eliminar la reserva
        $reserva->delete();
    }

    // Redirigir con un mensaje de éxito
    return redirect()->route('clases');
}


    public function cancelarReserva($claseId)
    {
        // Encuentra la reserva correspondiente al usuario autenticado y la clase específica
        $reserva = Reserva::where('id_clase', $claseId)->where('id_usuario', Auth::id())->first();
    
        // Verificar si la reserva existe
        if ($reserva) {
            // Eliminar la reserva
            $reserva->delete();
    
            // Actualizar cupos_clases del usuario (sumar 1)
            Auth::user()->increment('cupos_clases');
    
            // Redirigir con un mensaje de éxito
            return redirect()->route('clases');
        } else {
            // Si la reserva no existe, redirigir con un mensaje de error
            return redirect()->route('clases');
        }
    }

    public function cancelarReservaAdmin($claseId, $userId)
    {
        // Encuentra la reserva correspondiente al usuario y la clase específica
        $reserva = Reserva::where('id_clase', $claseId)
                          ->where('id_usuario', $userId)
                          ->first();
    
        // Verificar si la reserva existe
        if ($reserva) {
            // Eliminar la reserva
            $reserva->delete();
    
            // Actualizar cupos_clases del usuario (sumar 1)
            $usuario = User::find($userId);
            if ($usuario) {
                $usuario->increment('cupos_clases');
            }
    
            // Redirigir con un mensaje de éxito
            return redirect()->route('clases')
                             ->with('success', 'Reserva cancelada correctamente.');
        } else {
            // Si la reserva no existe, redirigir con un mensaje de error
            return redirect()->route('clases')
                             ->with('error', 'No se encontró la reserva.');
        }
    }
}