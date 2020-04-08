<?php

namespace App\Http\Controllers;

use App\Entities\Invoice;
use App\Entities\Payment;
use App\Services\PaymentService;
use App\Services\Structure\PaymentRequest;
use Dnetix\Redirection\Entities\Status;

class PaymentController extends Controller
{
    /**
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Invoice $invoice)
    {
        if (!$this->canMakePayment($invoice)) {
            alert()->warning(__('Warning'), __('Your invoice is pending or payment time has expired'));

            return redirect()->route('invoices.index');
        }

        $data = [
            'reference'   => $invoice->id,
            'customer'    => $invoice->customer,
            'amount'      => $invoice->total,
            'description' => $invoice->description,
        ];

        if (!$this->generatePayment($data)) {
            alert()->warning(__('Warning'), __('Your invoice is pending or payment time has expired'));

            return redirect()->route('invoices.index');
        }
    }

    public function generatePayment($data)
    {
        $paymentService = new PaymentService;
        $responseService = $paymentService->createPayment(new PaymentRequest($data));
        if ($responseService['status'] != Status::ST_OK) {
            return false;
        }

        $data = [
            'request_id'  => $responseService['response']->getRequestId(),
            'reference'   => $responseService['request']->getReference(),
            'state'       => config('invoices.Pending'),
            'description' => $responseService['request']->getDescription(),
            'return_url'  => $responseService['response']->getUrl(),
            'ip_address'  => $responseService['request']->toArray()['ipAddress'],
            'invoice_id'  => $responseService['request']->toArray()['payment_concept'],
        ];

        try {
            $payment = Payment::create($data);
            redirect($payment->toArray()['return_url']);
        } catch (\Exception $e) {

            return false;
        }
    }

    public function canMakePayment($request)
    {
        if ($request->state != config('invoices.Pending')) {
            return false;
        }
        return true;
    }

    public function returnWebCheckout($reference)
    {
        dd($reference);
    }

}
