<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchaseorder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function products()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
        // $this->hasMany('class namespace', 'foreign key')
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }

}
