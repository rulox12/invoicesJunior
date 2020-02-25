<?php

namespace App\Http\Controllers;

use App\Entities\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Services\PaymentService;
use App\Services\Structure\PaymentRequest;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Invoice $invoice)
    {
        if (!$this->canMakePayment($invoice)) {
            alert()->warning(__('Warning'), __('Invoice'));

            return redirect()->route('invoices.index');
        }

        $data = [
            'reference' => $invoice->consecutive,
            'customer' => $invoice->customer,
            'amount' => $invoice->total,
            'description' => $invoice->description,
        ];

        $this->generatePayment($data);
    }

    public function generatePayment($data)
    {
        $paymentService = new PaymentService;
        $paymentService->createPayment(new PaymentRequest($data));

    }

    public function canMakePayment($request)
    {
        if ($request->state != config('invoices.Pending')) {
            return false;
        }
        return true;
    }
}
