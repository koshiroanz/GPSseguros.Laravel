<?php

namespace gps\Http\Controllers\Auth;

use gps\User;
use gps\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/';

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
            'dni' => 'required|string|max:11',
            'apellido' => 'required|string|max:25',
            'nombre' => 'required|string|max:25',
            'direccion' => 'required|string|max:55',
            'telefono1' => 'required|string|max:25',
            'privilegio' => 'required',
            'estado' => 'required',
            'localidad' => 'required',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \gps\User
     */
    protected function create(array $data)
    {
        return User::create([
            'dni' => $data['dni'],
            'apellido' => strtoupper($data['apellido']),
            'nombre' => strtoupper($data['nombre']),
            'direccion' => strtoupper($data['direccion']),
            'telefono1' => $data['telefono1'],
            'telefono2' => $data['telefono2'],
            'privilegio' => $data['privilegio'],
            'estado' => $data['estado'],
            'localidad_id' => $data['localidad'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
