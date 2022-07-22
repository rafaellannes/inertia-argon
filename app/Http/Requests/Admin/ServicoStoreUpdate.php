<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServicoStoreUpdate extends FormRequest
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
            'titulo' => ['required'],
            'contato' => ['required'],
            'descricao' => ['required'],
            'subcategoria_id' => ['required'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'endereco' => ['required'],
            'tags' => ['required'],
            'redes' => ['required', 'array', 'min:1'],
            'redes.*.rede_id' => ['required'],
            'redes.*.link' => ['required'],


        ];
    }
}
