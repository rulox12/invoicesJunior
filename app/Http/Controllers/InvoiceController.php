<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use App\Entities\Invoice;
use App\Entities\Seller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Imports\InvoicesImport;
use Facades\App\Repository\Sellers;
use Facades\App\Repository\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $customers = Customer::all();
        $sellers = Seller::all();

        $invoices = $this->filterPagination(
            $request->get('type'),
            $request->get('value')
        );

        return view(
            'invoices.index',
            compact(['invoices', 'data', 'customers', 'sellers'])
        );
    }

    public function create()
    {
        $customers = Customers::all('name');
        $sellers = Sellers::all('name');

        return view('invoices.create', compact(['customers', 'sellers']));
    }

    public function store(StoreInvoiceRequest $request, Invoice $invoice)
    {
        $data = $request->validated();

        Invoice::create($data);
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
        $customers = Customers::all('name');
        $sellers = Sellers::all('name');

        $invoice->load('user');

        return view('invoices.edit', [
            'invoice' => $invoice,
            'customers' => $customers,
            'sellers' => $sellers,
        ]);
    }

    public function update(UpdateInvoiceRequest $request, $id)
    {
        $data = $request->validated();

        $invoice = Invoice::find($id);
        $invoice->update($data);

        return redirect()->route('invoices.show', $invoice);
    }

    public function editStatus(Invoice $invoice)
    {
        $status = Config::get('invoices.state');

        return view('invoices.status', [
            'invoice' => $invoice,
            'states' => $status
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $data = [
            'state' => $request->get('state'),
        ];

        $invoice = Invoice::find($id);
        $invoice->update($data);

        return redirect()->route('invoices.index');
    }

    public function importExcelShow()
    {
        return view('invoices.import');
    }

    public function importExcelSave(Request $request)
    {
        $request->validate([
            'select_file' => 'required|max:50000|mimes:xlsx',
        ]);

        try {
            Excel::import(new InvoicesImport, request()->file('select_file'));

            alert()->success(__('Successful'), __('It was imported correctly'));

            return redirect()->route('invoices.index');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $row = $e->failures()[0]->row() - 1;
            $error = $e->failures()[0]->errors()[0];

            alert()->error(
                __('Error'),
                __("Register number: ") . $row . " " . __("failure") . " " . $error
            )
                ->persistent(true);

            return redirect()->route('invoices.import');
        }
    }

    public function filterDate(Request $request)
    {
        $data = $request->all();
        $customers = Customer::all();
        $sellers = Seller::all();

        $invoices = Invoice::orderBy('id', 'DESC')
            ->filterDate(
                $request->get('type'),
                $request->get('from'),
                $request->get('to')
            )
            ->paginate(5);

        return view('invoices.index', compact(['invoices', 'data', 'customers', 'sellers']));
    }

    public static function filterPagination($type, $value)
    {
        return Invoice::orderBy('id', 'DESC')
            ->filter($type, $value)
            ->paginate(5);
    }
}
