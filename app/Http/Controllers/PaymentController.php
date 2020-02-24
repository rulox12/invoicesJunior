<?php

namespace App\Http\Controllers;

use App\Entities\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request, Invoice $invoice,PaymentService $paymentService)
    {
        if (!$this->canMakePayment($invoice)) {
            alert()->warning(__('Warning'), __('Invoice'));

            return redirect()->route('invoices.index');
        }

        $data = [
            'reference'   => $invoice->consecutive,
            'client'      => $invoice->customer,
            'amount'      => $invoice->total,
            'description' => $invoice->description,
        ];

    }

    public function generatePayment()
    {

    }

    public function canMakePayment($request)
    {
        if ($request->state != config('invoices.Pending')) {
            return false;
        }
        return true;
    }
}
