<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    
    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
        // $this->hasMany('class namespace', 'foreign key')
    }

    public function suppliers()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
        // $this->hasMany('class namespace', 'foreign key')
    }

    public function purchaseorders()
    {
        return $this->hasMany('App\Models\Purchaseorder');
    }

    public function saleorders()
    {
        return $this->hasMany('App\Models\Saleorder');
    }

}

