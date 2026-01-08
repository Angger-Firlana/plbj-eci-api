<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchasedOrderDetail
 * 
 * @property int $id
 * @property int $purchased_order_id
 * @property int $quotation_detail_id
 * @property string $item_name
 * @property string $model
 * @property float $discount
 * @property float $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property PurchasedOrder $purchased_order
 * @property QuotationDetail $quotation_detail
 *
 * @package App\Models
 */
class PurchasedOrderDetail extends Model
{
	protected $table = 'purchased_order_details';

	protected $casts = [
		'purchased_order_id' => 'int',
		'quotation_detail_id' => 'int',
		'item_name' => 'string',
		'model' => 'string',
		'quantity'=> 'int',
		'discount' => 'float',
		'amount' => 'float'
	];

	protected $fillable = [
		'purchased_order_id',
		'quotation_detail_id',
		'item_name',
		'model',
		'quantity',
		'discount',
		'amount'
	];

	public function purchased_order()
	{
		return $this->belongsTo(PurchasedOrder::class);
	}

	public function quotation_detail()
	{
		return $this->belongsTo(QuotationDetail::class);
	}
}
