<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use App\Entities\User;
use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();

        $customers = $this->filterPagination(
            $request->get('type'),
            $request->get('value')
        );

        return view('customers.index', compact('customers', 'data'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $data = array_merge($request->toArray(),
            [
                "state" => true
            ]
        );

        $customer = Customer::create($data);

        alert()->success(__('Successful'), __('Stored record'));

        return redirect()->route('customers.index', $customer);
    }


    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'))->with('status', 'Profile updated!');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', [
            'customer' => $customer,
        ]);
    }

    public function update(StoreCustomerRequest $request, $id)
    {
        $data = $request->toArray();

        unset($data['_method'], $data['_token']);

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

}
