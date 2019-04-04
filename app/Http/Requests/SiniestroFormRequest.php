<?php

namespace gps\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class SiniestroFormRequest extends FormRequest
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
            'poliza'                => 'required',
            'cliente'               => 'required',
            'vehiculo'              => 'required',
            'conductor'             => 'required|max:50',
            'fechaSiniestro'        => 'required',
            'fechaDenunciaInterna'  => 'required',
            'fechaReclamoTercero'   => 'required',
            'terceroUno'            => 'required|max:50',
            'dominioUno'            => 'required|max:10',
            'conductorUno'          => 'required|max:50',
        ];
    }
}