<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

/**
 * @property string entity
 * @property string type
 * @property string status
 * @property null created_by
 */
class Export extends Model
{
    const PDF = 'pdf';
    const TXT = 'txt';
    const EXCEL = 'xlsx';
    const HTML = 'html';
    const SUCCESSFUL = 'successful';
    const ERROR = 'error';


    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entity',
        'type',
        'status',
        'user',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopeFilter($query, $type, $value)
    {
        if ($type == 'state') {
            $value = ($value == "true") ?
                true :
                false;

            return $query->where($type, 'LIKE', $value);
        }

        if ($type && $value) {
            return $query->where($type, 'LIKE', "%$value%");
        }
    }

}
