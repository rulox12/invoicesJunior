<?php

namespace App\Http\Controllers;

use App\Entities\Seller;
use App\Http\Requests\StoreSellerRequest;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        return view('sellers.index', [
            'sellers' => seller::paginate()
        ]);
    }

    public function create()
    {
        return view('sellers.create');
    }

    public function store(StoreSellerRequest $request)
    {
        $data = array_merge($request->toArray(),
            [
                "state" => true
            ]
        );

        $seller = seller::create($data);

        return redirect()->route('sellers.show', $seller);
    }


    public function show(seller $seller)
    {
        return view('sellers.show', compact('seller'))->with('status', 'Profile updated!');
    }

    public function edit(seller $seller)
    {
        return view('sellers.edit', [
            'seller' => $seller,
        ]);
    }

    public function update(StoreSellerRequest $request, $id)
    {
        $data = $request->toArray();

        unset($data['_method'],$data['_token']);

        seller::whereId($id)->update($data);
        $seller = seller::find($id);

        return redirect()->route('sellers.show', $seller);
    }

    public function toggle(seller $seller)
    {
        if ($seller->state) {
            $data = ["state" => false];
        } else {
            $data = ["state" => true];
        }

        $seller = seller::find($seller->id);
        $seller->update($data);

        return redirect()->route('sellers.index');
    }
}