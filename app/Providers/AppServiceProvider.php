<?php

namespace App\Providers;

use App\Entities\Customer;
use App\Entities\Invoice;
use App\Entities\Seller;
use App\Observer\UserObserver;
use App\Observers\CustomerObserver;
use App\Observers\InvoicesObserver;
use App\Observers\SellerObserver;
use App\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Customer::observe(CustomerObserver::class);
        Seller::observe(SellerObserver::class);
        User::observe(UserObserver::class);
        Invoice::observe(InvoicesObserver::class);
    }
}
