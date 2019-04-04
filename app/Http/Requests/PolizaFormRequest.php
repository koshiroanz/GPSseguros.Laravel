<?php

namespace gps\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class PolizaFormRequest extends FormRequest
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
            'numPoliza' => 'required|max:20',
            'vigenciaPedida' => 'required',
            'vigenciaPedidaHasta' => 'required',
            'estado' => 'required',
            'destino' => 'required|max:20',
            'observacion' => 'max:190',
            'vehiculo' => 'required',
            'categoria' => 'required',
            'cobertura' => 'required',
            'comp_seguro' => 'required',
        ];
    }
}