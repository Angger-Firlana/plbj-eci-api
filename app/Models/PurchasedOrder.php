<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchasedOrder
 * 
 * @property int $id
 * @property int|null $quotation_id
 * @property int $store_id
 * @property int $vendor_id
 * @property string $purchased_order_number
 * @property Carbon $purchased_order_date
 * @property Carbon $delivery_date
 * @property string $status
 * @property string|null $notes
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Quotation $quotation
 * @property Store $store
 * @property Vendor $vendor
 * @property Collection|PurchasedOrderDetail[] $purchased_order_details
 * @property Collection|Approval[] $approvals
 *
 * @package App\Models
 */
class PurchasedOrder extends Model
{
	protected $table = 'purchased_orders';

	protected $casts = [
		'quotation_id' => 'int',
		'store_id' => 'int',
		'vendor_id' => 'int',
		
		'purchased_order_date' => 'datetime',
		'delivery_date' => 'datetime'
	];

	protected $fillable = [
		'quotation_id',
		'store_id',
		'vendor_id',
		'term',
		'cost',
		'purchased_order_number',
		'purchased_order_date',
		'delivery_date',
		'expired_date',
		'status',
		'notes'
	];

	public function quotation()
	{
		return $this->belongsTo(Quotation::class);
	}

	public function store()
	{
		return $this->belongsTo(Store::class);
	}

	public function vendor()
	{
		return $this->belongsTo(Vendor::class);
	}

	public function purchased_order_details()
	{
		return $this->hasMany(PurchasedOrderDetail::class);
	}

	public function approvals(){
		return $this->morphMany(Approval::class, 'document');
	}
}
