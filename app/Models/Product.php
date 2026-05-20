<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUniqueIds;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'product';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'attributes' => 'array',
    ];
    protected $fillable = [
		'category_id',
		'supplier_name',
        'name',
		'handle',
        'description',
		'price',
        'attributes'
	];

    protected function getDefaultPicturesAttribute(): array
    {
        return $this->getAttribute("attributes")["default_pictures"] ?? [];
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_name', 'supplier_name');
    }
}
