<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LpbjItem
 * 
 * @property int $id
 * @property int $lpbj_id
 * @property string $media
 * @property string $name
 * @property int $quantity
 * @property string $article
 * @property int $store_id
 * @property string $general_ledger
 * @property string $cost_center
 * @property string $order
 * @property string $information
 * @property string|null $item_photo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Lpbj $lpbj
 * @property Store $store
 * @property Collection|DetailItem[] $detail_items
 * @property Collection|QuotationDetail[] $quotation_details
 *
 * @package App\Models
 */
class LpbjItem extends Model
{
	protected $table = 'lpbj_items';

	protected $casts = [
		'lpbj_id' => 'int',
		'quantity' => 'int',
		'store_id' => 'int'
	];

	protected $fillable = [
		'lpbj_id',
		'media',
		'name',
		'quantity',
		'article',
		'store_id',
		'general_ledger',
		'cost_center',
		'order',
		'information',
		'item_photo'
	];

	public function lpbj()
	{
		return $this->belongsTo(Lpbj::class);
	}

	public function store()
	{
		return $this->belongsTo(Store::class);
	}

	public function detail_items()
	{
		return $this->hasMany(DetailItem::class);
	}

	public function quotation_details()
	{
		return $this->hasMany(QuotationDetail::class, 'item_id');
	}
}
