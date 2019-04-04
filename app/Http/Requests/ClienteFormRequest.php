<?php

namespace gps\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
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
            'dni'               => 'required|max:11|unique:cliente,dni',
            'apellido'          => 'required|max:20',
            'nombre'            => 'required|max:20',
            'fechaNacimiento'   => 'required',
            'cuit'              => 'max:15',
            'direccion'         => 'required|max:50',
            'telefono1'         => 'required|max:20',
            'telefono2'         => 'max:20',
            'localidad'         => 'required',
            'estadoCivil'       => 'required',
            'estado'            => 'required',
            'productor'         => 'required',
        ];
    }
}