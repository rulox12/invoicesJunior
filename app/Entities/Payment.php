<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const REQUEST_ID = 'request_id';

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
        'return_url',
        'ip_address',
        'description',
        'state',
        'invoice_id'
    ];

    public function getRequestId()
    {
        return $this->request_id;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getInvoiceId()
    {
        return $this->invoice_id;
    }

    public function getReturnUrl()
    {
        return $this->return_url;
    }


    public static function getAllPaymentForInvoice($invoice_id)
    {
        return Payment::where('invoice_id', '=', $invoice_id)->get();
    }

    public function scopeFilter($query, $type, $value)
    {
        if ($type && $value) {
            return $query->where($type, 'LIKE', "%$value%");
        }
    }
}
