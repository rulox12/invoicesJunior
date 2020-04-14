<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use App\Http\Requests\StoreCustomerRequest;
use Facades\App\Repository\Customers;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * CustomerController constructor.
     */
    public function __construct()
    {
        $this->middleware('permission:customer list|customer create|customer edit|customer delete', ['only' => ['index','show']]);
        $this->middleware('permission:customer create', ['only' => ['create','store']]);
        $this->middleware('permission:customer edit', ['only' => ['edit','update']]);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $customers = $this->filterPagination(
            $request->get('type'),
            $request->get('value')
        );

        return view('customers.index', compact(['customers', 'data']));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request, Customer $customer)
    {
        $customer = $this->saveData($request, new Customer());

        Customers::deleteChacheKey("name");

        alert()->success(__('Successful'), __('Stored record'));

        return redirect()->route('customers.index', $customer);
    }


    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(StoreCustomerRequest $request, $id)
    {
        $data = $request->validated();

        Customers::deleteChacheKey("name");

        $customer = Customer::find($id);
        $customer->update($data);

        return redirect()->route('customers.show', $customer);
    }

    public function toggle(Customer $customer)
    {
        if ($customer->state) {
            $data = ["state" => false];
        } else {
            $data = ["state" => true];
        }

        $customer = Customer::find($customer->id);
        $customer->update($data);

        return redirect()->route('customers.index');
    }

    public static function filterPagination($type, $value)
    {
        return Customer::orderBy('id', 'DESC')
            ->filter($type, $value)
            ->paginate(5);
    }

    private function saveData(Request $request, Customer $customer): Customer
    {
        $customer->name = $request->input('name');
        $customer->surname = $request->input("surname");
        $customer->type_document = $request->input("type_document");
        $customer->document = $request->input("document");
        $customer->state = 1;
        $customer->save();

        return $customer;
    }
}
