<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:50'],
        'apellido_1' => ['required', 'string', 'max:40'],
        'apellido_2' => ['nullable', 'string', 'max:40'],
        'dni' => ['required', 'string', 'regex:/^(?:(?:[XYZ]\d{7})|(?:\d{8}))[A-Z]$/', 'unique:users,dni'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|es)$/i'],
        'password' => ['required', 'string', 'between:8,16', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
    ]);
}



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
{
    return User::create([
        'name' => $data['name'],
        'apellido_1' => $data['apellido_1'],
        'apellido_2' => $data['apellido_2'],
        'dni' => $data['dni'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);
}

}