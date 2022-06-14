<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreUpdateRequest extends FormRequest
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

        $rules =  [
            'name' => ['required'],
            'email' => ['required', 'email', "unique:users,email,{$this->id},id"],
            'password' => 'sometimes|required|min:6',
        ];

        if ($this->method() == 'PATCH') {
            $rules['password'] = ['nullable', 'string', 'min:6'];
        }

        return $rules;
    }
}
