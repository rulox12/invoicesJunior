<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use App\Entities\Invoice;
use App\Entities\Seller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Imports\InvoicesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class InvoiceController extends Controller
{

    public function index()
    {
        return view('invoices.index', [
            'invoices' => Invoice::paginate()
        ]);
    }

    public function create()
    {
        return view('invoices.create', [
            'customers' => Customer::all(),
            'sellers' => Seller::all(),
        ]);
    }

    public function store(StoreInvoiceRequest $request)
    {
        date_default_timezone_set('UTC');
        $data = array_merge($request->toArray(),
            [
                "user_id" => auth()->user()->id,
                "expedition_date" => date("Y-m-d H:i:s"),
                "consecutive" => Invoice::count(),
                "tax" => $request->toArray()['total'] * 0.16,
            ]
        );

        $invoice = Invoice::create($data);
        alert()->success(__('Successful'), __('Stored record'));

        return redirect()->route('invoices.index');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['customer', 'user', 'seller']);

        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $invoice->load('user');

        return view('invoices.edit', [
            'invoice' => $invoice,
            'customers' => Customer::all(),
            'sellers' => Seller::all(),
        ]);
    }

    public function update(UpdateInvoiceRequest $request, $id)
    {
        date_default_timezone_set('UTC');

        $data = $request->validated();

        $data = array_merge($data,
            [
                "user_id" => auth()->user()->id,
            ]
        );

        $invoice = Invoice::find($id)->update($data);

        return redirect()->route('invoices.show', $invoice);
    }

    public function editStatus(Invoice $invoice)
    {
        $status = [
            'FAILED' => 'Failed',
            'REJETED' => 'Rejected',
            'APPROVED' => 'Approved',
            'PENDING' => 'Pending',
        ];

        return view('invoices.status', [
            'invoice' => $invoice,
            'states' => $status
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $data = [
            'state' => $request->toArray()['state']
        ];

        Invoice::find($id)->update($data);

        return redirect()->route('invoices.index');
    }

    public function importExcelShow()
    {
        return view('invoices.import');
    }

    public function importExcelSave(Request $request)
    {
        try {
            Excel::import(new InvoicesImport, request()->file('select_file'));

            alert()->success(__('Successful'), __('It was imported correctly'));

            return redirect()->route('invoices.index');

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {

            $row = $e->failures()[0]->row() - 1;
            $error = $e->failures()[0]->errors()[0];

            alert()->error(__('Error'),
                __("Register number: ") . $row . " " . __("failure") . " " . $error)
                ->persistent(true);

            return redirect()->route('invoices.import');
        }
    }
}
