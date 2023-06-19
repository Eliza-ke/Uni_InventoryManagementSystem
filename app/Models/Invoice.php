<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public function purchaseorders()
    {
        return $this->belongsTo('App\Models\Purchaseorder', 'purchase_id');
        // $this->hasMany('class namespace', 'foreign key')
    }
}
