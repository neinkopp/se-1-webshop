<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingCartPosition extends Model
{
    protected $table = 'shopping_cart_position';
    protected $primaryKey = 'position_id';
    public $timestamps = false;
    protected $casts = [
        'selected_options' => 'array',
    ];
    protected $fillable = [
        'session_id',
        'product_id',
        'amount',
        'selected_options'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
