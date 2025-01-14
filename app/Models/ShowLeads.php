<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowLeads extends Model
{
    protected $fillable = [
        'name',
        'link',
    ];

    public function sources()
    {
        return $this->hasMany(ShowLeadsSource::class);
    }
}
