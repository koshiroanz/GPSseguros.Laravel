<?php

namespace gps\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagoFormRequest extends FormRequest
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
            'numRecibo'   => 'required|max:15',
            'fecha'       => 'required',
            'vehiculo'    => 'required',
            'poliza'      => 'required',
            'cuota'       => 'required',
            'importes'    => 'required',
            'total'       => 'required',
            'observacion' => 'max:100'
        ];
    }
}