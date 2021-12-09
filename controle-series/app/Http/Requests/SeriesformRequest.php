<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesformRequest extends FormRequest
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
            'nome' => 'required|min:3|max:30',
            'qtd_temporadas' => 'required|min:1|max:2',
            'qtd_episodios' => 'required|min:1|max:2'
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Campo Nome é obrigatório',
            'nome.min' => 'Nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'Nome deve ter no máximo 30 caracteres',
            'qtd_temporadas.required'=> 'Campo Temporadas é obrigatório',
            'qtd_episodios.required'=> 'Campo Ep. por Temporada é obrigatório'
        ];
    }
}
