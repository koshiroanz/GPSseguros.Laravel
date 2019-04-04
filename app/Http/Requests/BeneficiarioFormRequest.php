<?php

namespace gps\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class BeneficiarioFormRequest extends FormRequest
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
            'dni'        => 'required|max:11|unique:beneficiario,dni,',
            'apellido'   => 'required|max:20',
            'nombre'     => 'required|max:20',
            'direccion'  => 'required|max:50',
            'telefono1'  => 'required|max:20',
            'telefono'   => 'max:20',
            'parentesco' => 'max:20',
            'localidad'  => 'required',
            'cliente'    => 'required',
        ];
    }
}