<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
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
            'reference' => 'required|string|min:1|max:21|regex:/^[\pL\s\-]+$/u',
            'amount' => 'required|string|min:1|max:21|regex:/^[\pL\s\-]+$/u',
            'customer' => 'required|exists:customers,id',
            'description' => 'required|string|min:1|max:254|regex:/^[\pL\s\-]+$/u',
        ];
    }
}
