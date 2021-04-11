<?php

namespace App\Http\Controllers\API;

use App\Entities\Invoice;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Rules\DateHigherToday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Invoice as InvoiceResource;

class InvoiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function __construct()
    {
        $this->middleware('permission:invoice list|invoice create|invoice edit', ['only' => ['index','show']]);
        $this->middleware('permission:invoice create', ['only' => ['create','store']]);
        $this->middleware('permission:invoice edit', ['only' => ['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::all();

        return $this->sendResponse(InvoiceResource::collection($invoices), 'Invoice retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = $this->validateDataStore($data);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $invoice = Invoice::create($request->toArray());

        return $this->sendResponse(new InvoiceResource($invoice), 'Invoice created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['id'] = $id;

        $validator = $this->validateDataUpdate($data);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $invoice = $this->updateInvoice($data, $id);

        return $this->sendResponse(new InvoiceResource($invoice), 'Invoice update successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);

        if (is_null($invoice)) {
            return $this->sendError('Invoice not found.');
        }

        return $this->sendResponse(new InvoiceResource($invoice), 'Invoice retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function validateDataStore(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'due_date' => ['required', 'date', new DateHigherToday],
            'type' => 'required|string|min:1|max:50|regex:/^[\pL\s\-]+$/u',
            'description' => 'required|string|min:1|max:256|regex:/^[\pL\s\-]+$/u',
            'total' => 'required|integer',
            'customer_id' => 'required|exists:customers,id',
            'seller_id' => 'exists:sellers,id',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateDataUpdate(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'due_date' => ['date', new DateHigherToday],
            'id' => 'required|exists:invoices,id',
            'type' => 'string|min:1|max:50|regex:/^[\pL\s\-]+$/u',
            'description' => 'string|min:1|max:256|regex:/^[\pL\s\-]+$/u',
            'total' => 'integer',
            'customer_id' => 'exists:customers,id',
            'seller_id' => 'exists:sellers,id',
        ]);
    }

    private function updateInvoice($data, $id)
    {
        $invoice = Invoice::find($id);

        $invoice->update($data);

        return $invoice;
    }
}
