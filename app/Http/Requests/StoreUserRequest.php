<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:20|regex:/^[\pL\s\-]+$/u',
            'surname' => 'required|string|min:1|max:20|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email:rfc,dns',
            'role_id' => 'required|exists:roles,id',
            'type_document' => 'required|string|min:2|max:3',
            'document' => 'required|integer',
        ];
    }
}
