<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Invoice extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'consecutive' => $this->consecutive,
            'due_date' => $this->due_date,
            'customer' => $this->customer,
            'seller' => $this->seller,
            'type' => $this->type,
            'received_date' => $this->received_date,
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
