<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
            $request->validate([
                'name' => ['required', 'string', 'max:50'],
                'apellido_1' => ['required', 'string', 'max:40'],
                'apellido_2' => ['nullable', 'string', 'max:40'],
                'dni' => ['required', 'string', 'regex:/^(?:(?:[XYZ]\d{7})|(?:\d{8}))[A-Z]$/', 'unique:users,dni'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|es)$/i'],
                'password' => ['required', 'string', 'between:8,16', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
            ]);

        $user = User::create([
            'name' => $request->name,
            'apellido_1' => $request->apellido_1,
            'apellido_2' => $request->apellido_2,
            'dni' => $request->dni,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('index'));
    }
    
}