<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUniqueIds;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    public $timestamps = false;
    public $incrementing = false;
    protected $casts = [
        'attributes' => 'array',
    ];

    use HasUniqueIds;

    protected function getDefaultPicturesAttribute(): array
    {
        return $this->getAttribute("attributes")["default_pictures"] ?? [];
    }
}
