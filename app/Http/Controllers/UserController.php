<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Reserva;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Tarifa;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
{
    $sortableColumns = ['id', 'name', 'apellido_1', 'apellido_2', 'email', 'dni', 'id_tarifa', 'id_rol'];
    $sortColumn = $request->get('sort_by', 'id');
    $sortDirection = $request->get('sort_direction', 'asc');

    // Verificar si la columna de ordenación es válida
    if (!in_array($sortColumn, $sortableColumns)) {
        $sortColumn = 'id'; // Predeterminado a 'id' si la columna no es válida
    }

    // Aplicar búsqueda y ordenación
    $users = User::with(['tarifa', 'rol'])
        ->when($request->input('search_name'), function($query, $searchName) {
            $query->where('name', 'like', "%{$searchName}%")
                  ->orWhere('apellido_1', 'like', "%{$searchName}%")
                  ->orWhere('apellido_2', 'like', "%{$searchName}%");
        })
        ->when($request->input('search_dni'), function($query, $searchDni) {
            $query->where('dni', 'like', "%{$searchDni}%");
        })
        ->when($request->input('search_email'), function($query, $searchEmail) {
            $query->where('email', 'like', "%{$searchEmail}%");
        })
        ->orderBy($sortColumn, $sortDirection)
        ->paginate();

    return view('user.index', compact('users', 'sortColumn', 'sortDirection'))
        ->with('i', ($request->input('page', 1) - 1) * $users->perPage());
}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = new User();
        $tarifas = Tarifa::all();
        $roles = Role::all();

        return view('user.create', compact('user', 'tarifas', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $user = User::create($request->validated());

        if ($request->filled('id_tarifa')) {
            $user->asignarCuposClasesDesdeTarifa($user->id, $request->id_tarifa);
        }

        return Redirect::route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $user = User::with('tarifa', 'rol')->findOrFail($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $user = User::with('tarifa', 'rol')->findOrFail($id);
        $tarifas = Tarifa::all();
        $roles = Role::all();

        return view('user.edit', compact('user', 'tarifas', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());

        if ($request->filled('id_tarifa')) {
            $user->asignarCuposClasesDesdeTarifa($user->id, $request->id_tarifa);
        }

        return Redirect::route('user.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);

        // Eliminar todas las reservas del usuario
        Reserva::where('id_usuario', $user->id)->delete();

        // Eliminar las sesiones del usuario directamente desde la base de datos
        DB::table('sessions')->where('user_id', $user->id)->delete();

        // Eliminar el usuario
        $user->delete();

        return Redirect::route('user.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}