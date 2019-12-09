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
        'expedition_date',
        'due_date',
        'received_date',
        'type',
        'tax',
        'description',
        'total',
        'customer_id',
        'user_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
