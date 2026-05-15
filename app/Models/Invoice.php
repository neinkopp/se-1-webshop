<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\InvoicePosition;

class Invoice extends Model
{
	use HasFactory;

	protected $table = 'invoice';
	protected $primaryKey = 'invoice_id';

	public $timestamps = true;

	protected $fillable = [
		'token',
		'order_date',
	];

	public function positions(): HasMany
	{
		return $this->hasMany(InvoicePosition::class, 'invoice_id', 'invoice_id');
	}
}
