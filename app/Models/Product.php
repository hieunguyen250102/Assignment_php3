<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name', 'status', 'image', 'price', 'tag', 'sale_price', 'description', 'image_list', 'status', 'category_id', 'summary'
    ];

    public function category()
    {
        return $this->hasOne('App\Category');
    }
}
