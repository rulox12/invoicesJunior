<?php

namespace App\Http\Controllers;

use App\Constants\InvoiceStatuses;
use App\Entities\Invoice;
use App\Entities\Payment;
use App\Services\PaymentService;
use App\Services\Structure\PaymentRequest;
use Dnetix\Redirection\Entities\Status;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $request->all();

        $payments = $this->filterPagination(
            $request->get('type'),
            $request->get('value')
        );

        return view(
            'payments.index',
            compact(['payments', 'data'])
        );
    }

    /**
     * @param Invoice $invoice
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Invoice $invoice)
    {
        if (!$invoice->isAvailableForPayment()) {
            alert()->warning(__('Warning'), __('Your invoice is approved or payment time has expired'));

            return redirect()->route('invoices.index');
        }

        $data = [
            'reference' => $invoice->id,
            'customer' => $invoice->customer,
            'amount' => $invoice->total,
            'description' => $invoice->description,
        ];

        try {
            $payment = $this->generatePayment($data);
            $invoice->setStatus(Invoice::STATUS_IN_PROCESS);
            $invoice->update();

            return redirect()->away($payment->return_url);
        } catch (\Exception $e) {
            alert()->warning(__('Warning'), __('Error'));

            return redirect()->route('invoices.index');
        }
    }

    private function generatePayment($data): Payment
    {
        $paymentService = new PaymentService();
        $responseService = $paymentService->createPayment(new PaymentRequest($data));
        if ($responseService['status'] != Status::ST_OK) {
            throw new \Exception('Status payment failed');
        }

        $data = [
            'request_id' => $responseService['response']->getRequestId(),
            'reference' => $responseService['request']->getReference(),
            'state' => Status::ST_PENDING,
            'description' => $responseService['request']->getDescription(),
            'return_url' => $responseService['response']->getUrl(),
            'ip_address' => $responseService['request']->toArray()['ipAddress'],
            'invoice_id' => $responseService['request']->toArray()['payment_concept'],
        ];

        return Payment::create($data);
    }

    public function returnWebCheckout($reference)
    {
        $payment = Payment::where('reference', $reference)->first();

        if ($payment) {
            $paymentService = new PaymentService();
            $responseService = $paymentService->getInfoPayment($payment->getRequestId());

            if ($responseService['status'] != Status::ST_OK) {
                throw new \Exception('Status payment failed');
            }

            $data = [
                'state' => $responseService['response']->status(),
            ];

            try {
                $payment->update($data);
                if ($payment->getState() != Status::ST_PENDING) {
                    $invoice = Invoice::find($payment->getInvoiceId());
                    $invoice->updateStatus($payment->getState());
                    $invoice->update();
                }

                return view('payments.returnPayment', compact('payment'));
            } catch (\Exception $e) {
                //log
                dd($e);
            }
        }
    }

    public static function filterPagination($type, $value)
    {
        return Payment::orderBy('id', 'DESC')
            ->filter($type, $value)
            ->paginate(5);
    }
}
