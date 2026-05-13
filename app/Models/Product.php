<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false;
    protected $casts = [
        'attributes' => 'array',
    ];

    protected function getDefaultPicturesAttribute(): array
    {
        return $this->getAttribute("attributes")["default_pictures"] ?? [];
    }
}
