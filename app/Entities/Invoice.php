<?php

namespace App\Entities;

use App\Constants\InvoiceStatuses;
use App\User;
use Dnetix\Redirection\Entities\Status;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    const STATUS_IN_PROCESS = 'IN_PROCESS';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_EXPIRED = 'EXPIRED';
    const STATUS_PENDING = 'PENDING';

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

    public function setStatus($status)
    {
        $this->state = $status;
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

    public function isAvailableForPayment(): bool
    {
        return $this->state == Invoice::STATUS_PENDING;
    }

    public function updateStatus($status)
    {
        if ($status == Status::ST_APPROVED) {
            $this->state = Invoice::STATUS_APPROVED;
        } else {
            $this->state = Invoice::STATUS_PENDING;
        }
    }
}
