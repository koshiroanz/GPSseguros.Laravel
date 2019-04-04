<?php

namespace gps\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompaniaSeguroFormRequest extends FormRequest
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
            'nombre' => 'required|max:20|unique:companiaseguro,nombre',  // Verificar esta entrada => unique:companiaseguro por el nombre del atributo o clase
            'etiqueta' => 'nullable|max:55',
            'direccion' => 'required|max:55',
            'telefono1' => 'required|max:20',
            'telefono2' => 'max:20',
            'fax' => 'max:20',
            'email' => 'max:55',
            'paginaweb' => 'max:55',
            'logo_img' => 'image|max:1999',
            'localidad' => 'required',
        ];
    }
}