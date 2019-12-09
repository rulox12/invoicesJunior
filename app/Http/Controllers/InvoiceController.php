<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use App\Entities\Invoice;
use App\Entities\Role;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        ]);
    }

    public function store(StoreInvoiceRequest $request)
    {
        date_default_timezone_set('UTC');

        $data = array_merge($request->toArray(),
            [
                "user_id" => auth()->user()->id,
                "expedition_date" => date("Y-m-d H:i:s")
            ]
        );

        $invoice = Invoice::create($data);

        return redirect()->route('invoices.show', $invoice)->with('success', 'Show is successfully saved');
    }


    public function show(Invoice $invoice)
    {
        $invoice->load(['customer', 'user']);

        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $invoice->load('user');

        return view('invoices.edit', [
            'invoice' => $invoice,
            'customers' => Customer::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        date_default_timezone_set('UTC');


        $data = $request->validate([
            'due_date' => 'required',
            'type' => 'required',
            'tax' => 'required',
            'description' => 'required',
            'total' => 'required',
        ]);


        $data = array_merge($data,
            [
                "user_id" => auth()->user()->id,
            ]
        );
        $invoice = Invoice::whereId($id)->update($data);


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

        Invoice::whereId($id)->update($data);
        $invoice = Invoice::find($id);

        return redirect()->route('invoices.index');
    }


}
