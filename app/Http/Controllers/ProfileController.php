<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request): RedirectResponse
{
    $user = $request->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
    ], [
        'name.required' => 'El campo nombre es requerido.',
        'email.required' => 'El campo email es requerido.',
        'email.email' => 'Debe ser una dirección de correo válida.',
        'email.unique' => 'Este correo electrónico ya está en uso.',
    ]);

    $user->fill($request->only(['name', 'email']));

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }

    $user->save();

    return redirect()->route('profile.edit')->with('status', 'profile-updated');
}

public function updatePassword(Request $request): RedirectResponse
{
    $request->validate([
        'current_password' => 'required|current_password',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'current_password.required' => 'La contraseña actual es requerida.',
        'password.required' => 'Necesitas una nueva contraseña.',
        'password.confirmed' => 'Las contraseñas no coinciden.',
        'password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
    ]);

    $request->user()->password = Hash::make($request->password);
    $request->user()->save();

    return redirect()->route('profile.edit')->with('status', 'password-updated');
}

    /**
     * Delete the user's account.
     */
public function destroy(Request $request): RedirectResponse
{
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ], [
        'password.required' => 'Se necesita introducir la contraseña para poder eliminar la cuenta.',
        'password.current_password' => 'La contraseña no es correcta.',
    ]);

    $user = $request->user();

    Auth::logout();

    // Eliminar todas las reservas del usuario
    DB::table('reservas')->where('id_usuario', $user->id)->delete();

    // Eliminar las sesiones del usuario directamente desde la base de datos
    DB::table('sessions')->where('user_id', $user->id)->delete();

    // Eliminar el usuario
    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
}

}