<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';
    public $timestamps = false;
    protected $primaryKey = 'category_id';
    protected $casts = [
        'filters' => 'array',
    ];
}
