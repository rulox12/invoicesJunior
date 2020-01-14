<?php

namespace App\Repository;

use App\Entities\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

define('CACHE_KEY_CUSTOMERS', Config::get('cache.customer.key'));

class Customers
{
    public function all($orderBy)
    {
        $key = "all.{$orderBy}";
        $cacheKey = $this->getChacheKey($key);

        return cache()->remember($cacheKey, Carbon::now()->addMinutes(3), function () use ($orderBy) {
            return Customer::orderBy($orderBy)->get();
        });
    }

    public function getChacheKey($key)
    {
        $key = strtoupper($key);

        return CACHE_KEY_CUSTOMERS.".$key";
    }

    public function deleteChacheKey($key_value)
    {
        $key = "all.{$key_value}";
        $cacheKey = $this->getChacheKey($key);

        cache()->delete($cacheKey);
    }
}
