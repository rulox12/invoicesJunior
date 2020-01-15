<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        $types = Config::get('import.types');

        return view('imports.index', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|max:50000|mimes:xlsx',
        ]);

        $model= $request->input('type');

        try {
            Excel::import(new $model, request()->file('file'));

            alert()->success(__('Successful'), __('It was imported correctly'));

            return redirect()->route('imports.index');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $row = $e->failures()[0]->row() - 1;
            $error = $e->failures()[0]->errors()[0];

            alert()->error(
                __('Error'),
                __("Register number: ") . $row . " " . __("failure") . " " . $error
            )
                ->persistent(true);

            return redirect()->route('imports.index');
        }
    }
}
