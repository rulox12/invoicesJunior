<?php

namespace App\Http\Requests;

use App\Rules\DateHigherToday;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'due_date' => ['required', 'date', new DateHigherToday],
            'type' => 'required|string|min:1|max:50|regex:/^[\pL\s\-]+$/u',
            'description' => 'required|string|min:1|max:256|regex:/^[\pL\s\-]+$/u',
            'total' => 'required|integer',
            'customer_id' => 'required|exists:customers,id',
            'seller_id' => 'required|exists:sellers,id',
        ];
    }
}
