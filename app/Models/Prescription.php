<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
