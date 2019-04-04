<?php

namespace gps\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'dni' => 'required|max:11|unique:users,dni', // Creo que debería tanto en dni como email un unique:users por n° único
            'apellido' => 'required|string|max:30',
            'nombre' => 'required|string|max:30',
            'direccion' => 'required|max:55',
            'telefono1' => 'required|max:25',
            'privilegio' => 'required|max:11',
            'estado' => 'required|max:10',
            'localidad' => 'required',
            'email' => 'required|string|email|max:30|unique:users',
            'password' => 'required_with:password_confirmation|string|min:6|same:password_confirmation',
        ];
    }
}
