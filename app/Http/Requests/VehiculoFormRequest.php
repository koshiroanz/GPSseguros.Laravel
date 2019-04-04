<?php

namespace gps\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculoFormRequest extends FormRequest
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
            'dominio' => 'required|max:15|unique:vehiculo,dominio',
            'anio' => 'required|numeric',
            'chasis' => 'required|max:25',
            'motor' => 'required|max:20',
            'carroceria' => 'required',
            'modelo' => 'required',
            'marca' => 'required',
            'cliente' => 'required',
        ];
    }
}