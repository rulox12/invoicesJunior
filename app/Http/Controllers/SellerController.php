<?php

namespace App\Http\Controllers;

use App\Entities\Seller;
use App\Entities\User;
use App\Http\Requests\StoreSellerRequest;
use Facades\App\Repository\Sellers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    use RefreshDatabase;

    public function index(Request $request)
    {
        $data = $request->all();

        $sellers = $this->filterPagination(
            $request->get('type'),
            $request->get('value')
        );

        return view('sellers.index', compact('sellers', 'data'));
    }

    public function create()
    {
        return view('sellers.create');
    }

    public function store(StoreSellerRequest $request, Seller $customer)
    {
        $seller = $this->saveData($request, new Seller());

        Sellers::deleteChacheKey("name");

        alert()->success(__('Successful'), __('Stored record'));

        return redirect()->route('sellers.index', $seller);
    }


    public function show(Seller $seller)
    {
        return view('sellers.show', compact('seller'));
    }

    public function edit(Seller $seller)
    {
        return view('sellers.edit', compact('seller'));
    }

    public function update(StoreSellerRequest $request, $id)
    {
        $data = $request->validated();

        $seller = Seller::find($id);
        $seller->update($data);

        Sellers::deleteChacheKey("name");

        return redirect()->route('sellers.show', $seller);
    }

    public function toggle(Seller $seller)
    {
        if ($seller->state) {
            $data = ["state" => false];
        } else {
            $data = ["state" => true];
        }

        $seller = Seller::find($seller->id);
        $seller->update($data);

        return redirect()->route('sellers.index');
    }

    public static function filterPagination($type, $value)
    {
        return Seller::orderBy('id', 'DESC')
            ->filter($type, $value)
            ->paginate(5);
    }

    private function saveData(Request $request, Seller $seller): Seller
    {
        $seller->name = $request->input('name');
        $seller->surname = $request->input("surname");
        $seller->type_document = $request->input("type_document");
        $seller->document = $request->input("document");
        $seller->state = 1;
        $seller->save();

        return $seller;
    }
}
