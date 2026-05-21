<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_category';
    public $timestamps = false;
    protected $primaryKey = 'category_id';
    protected $casts = [
        'filters' => 'array',
    ];

    protected $fillable = [
		'name',
		'filters'
	];
}
