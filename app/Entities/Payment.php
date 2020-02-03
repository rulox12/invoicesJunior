<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_id',
        'reference',
        'description',
        'expiration',
        'return_url',
        'ip_address',
        'tax',
        'description',
        'total',
        'customer_id',
        'seller_id',
        'state'
    ];
}
