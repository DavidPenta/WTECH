<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'Order';
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function orderProducts() {
        return $this->hasMany('App\Models\OrderProduct');
    }
}
