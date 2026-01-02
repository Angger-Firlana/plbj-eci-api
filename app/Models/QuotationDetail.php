<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuotationDetail
 * 
 * @property int $id
 * @property int $quotation_id
 * @property int $item_id
 * @property int $quantity
 * @property float $price
 * @property string|null $remarks
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property LpbjItem $lpbj_item
 * @property Quotation $quotation
 * @property Collection|PurchasedOrderDetail[] $purchased_order_details
 *
 * @package App\Models
 */
class QuotationDetail extends Model
{
	protected $table = 'quotation_details';

	protected $casts = [
		'quotation_id' => 'int',
		'item_id' => 'int',
		'quantity' => 'int',
		'price' => 'float'
	];

	protected $fillable = [
		'quotation_id',
		'item_id',
		'quantity',
		'price',
		'remarks'
	];

	public function lpbj_item()
	{
		return $this->belongsTo(LpbjItem::class, 'item_id');
	}

	public function quotation()
	{
		return $this->belongsTo(Quotation::class);
	}

	public function purchased_order_details()
	{
		return $this->hasMany(PurchasedOrderDetail::class);
	}
}
