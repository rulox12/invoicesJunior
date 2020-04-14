<?php

namespace App\Http\Controllers\API;

use App\Entities\Seller;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Seller as SellerResource;

class SellerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     */
    public function __construct()
    {
        $this->middleware('permission:seller list|seller create|seller edit', ['only' => ['index','show']]);
        $this->middleware('permission:seller create', ['only' => ['create','store']]);
        $this->middleware('permission:seller edit', ['only' => ['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seller = Seller::all();

        return $this->sendResponse(SellerResource::collection($seller), 'Seller retrieved successfully.');
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

        $seller = Seller::create($request->toArray());

        return $this->sendResponse(new SellerResource($seller), 'Seller created successfully.');
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

        $seller = $this->updateSeller($data, $id);

        return $this->sendResponse(new SellerResource($seller), 'Seller update successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = Seller::find($id);

        if (is_null($seller)) {
            return $this->sendError('Seller not found.');
        }

        return $this->sendResponse(new SellerResource($seller), 'Seller retrieved successfully.');
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
            'id' => 'required|exists:sellers,id',
            'name' => 'string|min:1|max:21|regex:/^[\pL\s\-]+$/u',
            'surname' => 'string|min:1|max:21|regex:/^[\pL\s\-]+$/u',
            'type_document' => 'string|min:2|max:3',
            'document' => 'integer',
        ]);
    }

    private function updateSeller($data, $id)
    {
        $seller = Seller::find($id);

        $seller->update($data);

        return $seller;
    }
}
