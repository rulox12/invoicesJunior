<?php

namespace App\Http\Controllers;

use App\Entities\Customer;
use App\Entities\Invoice;
use App\Entities\Role;
use App\Entities\User;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\StoreUserRequest;
use Cassandra\Custom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers.index', [
            'customers' => Customer::paginate()
        ]);
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

        return redirect()->route('customers.show', $customer);
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

        unset($data['_method'],$data['_token']);

        Customer::whereId($id)->update($data);
        $customer = Customer::find($id);

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
}
