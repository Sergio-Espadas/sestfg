<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $sortableColumns = ['id', 'name'];
        $sortColumn = $request->get('sort_by', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
    
        // Verificar si la columna de ordenación es válida
        if (!in_array($sortColumn, $sortableColumns)) {
            $sortColumn = 'id'; // Predeterminado a 'id' si la columna no es válida
        }
    
        // Aplicar filtros de búsqueda
        $query = Role::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
    
        // Aplicar ordenación
        $roles = $query->orderBy($sortColumn, $sortDirection)->paginate();
    
        return view('role.index', compact('roles', 'sortColumn', 'sortDirection'))
            ->with('i', ($request->input('page', 1) - 1) * $roles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $role = new Role();

        return view('role.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        Role::create($request->validated());

        return Redirect::route('role.index')
            ->with('success', 'Rol creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $role = Role::find($id);

        return view('role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $role = Role::find($id);

        return view('role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        $role->update($request->validated());

        return Redirect::route('role.index')
            ->with('success', 'Rol actualizado correctamente');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        // Verificar si hay usuarios asociados a este rol
        $usuariosConRol = User::where('id_rol', $id)->exists();

        if ($usuariosConRol) {
            // Si hay usuarios con este rol, mostrar un mensaje de error
            return redirect()->route('role.index')->with('error', 'Este rol está asociado a usuarios.');
        } else {
            // Si no hay usuarios con este rol, eliminarlo directamente
            $role->delete();
            return redirect()->route('role.index')->with('success', 'Rol eliminado correctamente.');
        }
    }
}