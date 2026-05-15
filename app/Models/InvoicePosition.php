<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoicePosition extends Model
{
	use HasFactory;

	protected $table = 'invoice_position';
	protected $primaryKey = 'invoice_position_id';

	public $timestamps = false;

	protected $fillable = [
		'invoice_id',
		'product_id',
		'amount',
		'price_per_unit',
		'selected_options',
	];

	protected $casts = [
		'selected_options' => 'array',
	];

	public function invoice(): BelongsTo
	{
		return $this->belongsTo(Invoice::class, 'invoice_id', 'invoice_id');
	}

	public function product(): BelongsTo
	{
		return $this->belongsTo(Product::class, 'product_id', 'id');
	}
}
