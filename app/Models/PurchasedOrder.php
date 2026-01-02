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
 * @property int $quotation_id
 * @property int $store_id
 * @property string $vendor_id
 * @property string $number_po
 * @property string $term
 * @property string $model
 * @property string $cost
 * @property string $note
 * @property Carbon $date
 * @property Carbon $delivery_date
 * @property string $status
 * @property Carbon $expired_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Quotation $quotation
 * @property Store $store
 * @property Collection|PurchasedOrderDetail[] $purchased_order_details
 *
 * @package App\Models
 */
class PurchasedOrder extends Model
{
	protected $table = 'purchased_orders';

	protected $casts = [
		'quotation_id' => 'int',
		'store_id' => 'int',
		'date' => 'datetime',
		'delivery_date' => 'datetime',
		'expired_date' => 'datetime'
	];

	protected $fillable = [
		'quotation_id',
		'store_id',
		'vendor_id',
		'number_po',
		'term',
		'model',
		'cost',
		'note',
		'date',
		'delivery_date',
		'status',
		'expired_date'
	];

	public function quotation()
	{
		return $this->belongsTo(Quotation::class);
	}

	public function store()
	{
		return $this->belongsTo(Store::class);
	}

	public function purchased_order_details()
	{
		return $this->hasMany(PurchasedOrderDetail::class);
	}
}
