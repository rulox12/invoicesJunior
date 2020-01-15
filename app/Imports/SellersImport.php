<?php

namespace App\Imports;

use App\Entities\Seller;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SellersImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Seller([
            'name' => $row['name'],
            'surname' => $row['surname'],
            'type_document' => $row['type_document'],
            'document' => $row['document'],
        ]);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:21|regex:/^[\pL\s\-]+$/u',
            'surname' => 'required|string|min:1|max:21|regex:/^[\pL\s\-]+$/u',
            'type_document' => 'required|string|min:2|max:3',
            'document' => 'required|integer',
        ];
    }
}
