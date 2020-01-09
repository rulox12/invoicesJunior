<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'description',
    ];

    public $translatable = ['name'];

    protected $appends = ['locale_name'];

    public function getLocaleNameAttribute()
    {
        return $this->getAttribute('name');
    }
}
