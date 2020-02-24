<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'consecutive',
        'expedition_date',
        'due_date',
        'received_date',
        'type',
        'tax',
        'description',
        'total',
        'customer_id',
        'seller_id',
        'state'

    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function isPending($status)
    {
        return $status == config('state.');
    }

    //scope
    public function scopeFilterDate($query, $type, $from, $to)
    {
        if ($type && $from && $to) {
            return $query->where($type, '>=', $from)
                ->where($type, '<=', $to);
        }
    }

    public function scopeFilter($query, $type, $value)
    {
        if ($type && $value) {
            return $query->where($type, 'LIKE', "%$value%");
        }
    }
}
