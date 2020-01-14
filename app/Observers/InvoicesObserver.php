<?php

namespace App\Observers;

use App\Entities\Invoice;
use Carbon\Carbon;

class InvoicesObserver
{
    public function creating(Invoice $invoice)
    {
        $date = Carbon::now('America/Bogota');
        $invoice->created_by = auth()->user()->id ?? null;
        $invoice->expedition_date = $date;
        $invoice->consecutive = Invoice::count();
        $invoice->tax = $invoice->total * 0.16;
    }

    public function updating(Invoice $invoice)
    {
        $invoice->updated_by = auth()->user()->id ?? null;
        $invoice->tax = $invoice->total * 0.16;
    }
}
