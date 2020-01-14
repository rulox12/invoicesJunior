<?php

namespace App\Repository;

use App\Entities\Seller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

define('CACHE_KEY_SELLERS', Config::get('cache.sellers.key'));

class Sellers
{
    public function all($orderBy)
    {
        $key = "all.{$orderBy}";
        $cacheKey = $this->getChacheKey($key);

        return cache()->remember($cacheKey, Carbon::now()->addMinutes(3), function () use ($orderBy) {
            return Seller::orderBy($orderBy)->get();
        });
    }

    public function getChacheKey($key)
    {
        $key = strtoupper($key);

        return CACHE_KEY_SELLERS.".$key";
    }

    public function deleteChacheKey($key_value)
    {
        $key = "all.{$key_value}";
        $cacheKey = $this->getChacheKey($key);

        cache()->delete($cacheKey);
    }
}
