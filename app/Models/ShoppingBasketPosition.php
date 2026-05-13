<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingBasketPosition extends Model
{
    protected $table = 'shopping_card_position';
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

    
}
