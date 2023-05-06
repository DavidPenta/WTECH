<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'Product';
    public $timestamps = false;
    public function orderProduct() {
        return $this->belongsTo('App\Models\OrderProduct');
    }

    public function images() {
        return $this->hasMany('App\Models\Image');
    }

    public function mainImage() {
        return $this->images()->where('type', '=', 'main')->one();
    }
}
