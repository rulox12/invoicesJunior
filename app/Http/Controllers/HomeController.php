<?php

namespace App\Http\Controllers;

use App\Charts\ModelChart;
use App\Entities\Customer;
use App\Entities\Seller;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->pluck('count');
        $customer = Customer::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->pluck('count');
        $sellers = Seller::select(\DB::raw("COUNT(*) as count"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(\DB::raw("Month(created_at)"))
            ->pluck('count');

        $chart = new ModelChart;

        $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
        $chart->dataset(__('News Users'), 'line', $users)->options([
            'fill' => 'true',
            'borderColor' => '#51C1C0'
        ]);
        $chart->dataset(__('News Customers'), 'line', $customer)->options([
            'fill' => 'true',
            'borderColor' => '#F27256'
        ]);
        $chart->dataset(__('News Sellers'), 'line', $sellers)->options([
            'fill' => 'true',
            'borderColor' => '#DACE16'
        ]);

        return view('home', compact('chart'));
    }
}
