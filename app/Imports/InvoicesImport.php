<?php

namespace App\Imports;

use App\Entities\Customer;
use App\Entities\Invoice;
use App\Entities\Seller;
use App\Rules\DateHigherToday;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class InvoicesImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $customer = Customer::where('document', $row['customer'])->first();
        $seller = Seller::where('document', $row['seller'])->first();
        $tax = $row['total'] * 0.16;

        return new Invoice([
            'due_date' => $row['due_date'],
            'type' => $row['type'],
            'tax' => $tax,
            'description' => $row['description'],
            'total' => $row['total'],
            'customer_id' => $customer->id,
            'seller_id' => $seller->id,
            'expedition_date' => date("Y-m-d H:i:s"),
            'user_id' => auth()->user()->id,
            "consecutive" => Invoice::count(),
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'due_date' => ['required', 'date', new DateHigherToday],
            'type' => 'required|string|min:1|max:50|regex:/^[\pL\s\-]+$/u',
            'description' => 'required|string|min:1|max:256|regex:/^[\pL\s\-]+$/u',
            'total' => 'required|integer',
            'customer' => 'required|exists:customers,document',
            'seller' => 'required|exists:sellers,document',
        ];
    }
}
