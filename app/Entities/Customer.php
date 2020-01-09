<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'type_document',
        'document',
        'state'
    ];

    public function scopeFilter($query, $type, $value)
    {
        if ($type == 'state') {
            $value = ($value == "true") ? true : false;

            return $query->where($type, 'LIKE', $value);
        }

        if ($type && $value)
            return $query->where($type, 'LIKE', "%$value%");
    }

}
