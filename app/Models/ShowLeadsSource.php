<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowLeadsSource extends Model
{
    
    public function showLead()
    {
        return $this->belongsTo(ShowLeads::class, 'show_lead_id');
    }
}
