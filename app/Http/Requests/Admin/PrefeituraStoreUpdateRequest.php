<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PrefeituraStoreUpdateRequest extends FormRequest
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
            'descricao' => "min:3|max:191|required|string|unique:prefeituras,descricao,{$this->id}",
            'dominio' => "min:3|max:191|required|string|unique:prefeituras,dominio,{$this->id}",
        ];
    }
}
