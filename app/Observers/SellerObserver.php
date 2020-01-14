<?php

namespace App\Observers;

use App\Entities\Seller;

class SellerObserver
{
    public function creating(Seller $seller)
    {
        $seller->created_by = auth()->user()->id ?? null;
    }

    public function updating(Seller $seller)
    {
        $seller->updated_by = auth()->user()->id ?? null;
    }
}
