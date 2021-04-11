<?php

namespace App\Http\Controllers;

use App\Entities\Export;
use App\Entities\Invoice;
use App\Exports\InvoicesExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $exports = $this->filterPagination(
            $request->get('type'),
            $request->get('value')
        );

        return view('exports.index', compact(['exports', 'data']));
    }

    /**
     * @param $type
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function generateExportInvoice($type)
    {
        try {
            $invoices = Invoice::all();
            if ($type == Export::TXT) {
                $response = Storage::put('invoices.txt', $invoices);
                if ($response) {
                    $this->store($type, Export::SUCCESSFUL);

                    return response()->download(storage_path("app/invoices.txt"));
                }
            } else {
                $response = Excel::download(new InvoicesExport(), 'invoices.' . $type);

                if ($response) {
                    $this->store($type, Export::SUCCESSFUL);

                    return $response;
                }
            }
            $this->store($type, Export::ERROR);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    /**
     * @param string $type
     * @param string $status
     */
    public function store(string $type, string $status)
    {
        $export = new Export();

        $export->entity = 'invoice';
        $export->type = $type;
        $export->status = $status;
        $export->created_by = auth()->user()->id ?? null;

        $export->save();
    }

    /**
     * @param $type
     * @param $value
     * @return mixed
     */
    public static function filterPagination($type, $value)
    {
        return Export::orderBy('id', 'DESC')
            ->filter($type, $value)
            ->paginate(10);
    }
}
