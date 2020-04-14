<?php

namespace App\Http\Controllers\API;

use App\Entities\Customer;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Customer as CustomerResource;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function __construct()
    {
        $this->middleware('permission:customer list|customer create|customer edit', ['only' => ['index','show']]);
        $this->middleware('permission:customer create', ['only' => ['create','store']]);
        $this->middleware('permission:customer edit', ['only' => ['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::all();

        return $this->sendResponse(CustomerResource::collection($customer), 'Customer retrieved successfully.');
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

        $customer = Customer::create($request->toArray());

        return $this->sendResponse(new CustomerResource($customer), 'Customer created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
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

        $customer = $this->updateCustomer($data, $id);

        return $this->sendResponse(new CustomerResource($customer), 'Customer update successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            return $this->sendError('Customer not found.');
        }

        return $this->sendResponse(new CustomerResource($customer), 'Customer retrieved successfully.');
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
            'name' => 'required|string|min:1|max:21|regex:/^[\pL\s\-]+$/u',
            'surname' => 'required|string|min:1|max:21|regex:/^[\pL\s\-]+$/u',
            'type_document' => 'required|string|min:2|max:3',
            'document' => 'required|integer',
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
            'id' => 'required|exists:customers,id',
            'name' => 'string|min:1|max:21|regex:/^[\pL\s\-]+$/u',
            'surname' => 'string|min:1|max:21|regex:/^[\pL\s\-]+$/u',
            'type_document' => 'string|min:2|max:3',
            'document' => 'integer',
        ]);
    }

    private function updateCustomer($data, $id)
    {
        $customer = Customer::find($id);

        $customer->update($data);

        return $customer;
    }
}
