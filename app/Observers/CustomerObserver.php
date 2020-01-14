<?php

namespace App\Observers;

use App\Entities\Customer;

class CustomerObserver
{
    public function creating(Customer $customer)
    {
        $customer->created_by = auth()->user()->id ?? null;
    }

    public function updating(Customer $customer)
    {
        $customer->updated_by = auth()->user()->id ?? null;
    }
}
