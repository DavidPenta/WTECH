<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = 'Order_product';
    public $timestamps = false;

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }
}

