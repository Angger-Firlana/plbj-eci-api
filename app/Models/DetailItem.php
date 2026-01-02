<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailItem
 * 
 * @property int $id
 * @property int $lpbj_item_id
 * @property string $detail
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property LpbjItem $lpbj_item
 *
 * @package App\Models
 */
class DetailItem extends Model
{
	protected $table = 'detail_items';

	protected $casts = [
		'lpbj_item_id' => 'int'
	];

	protected $fillable = [
		'lpbj_item_id',
		'detail'
	];

	public function lpbj_item()
	{
		return $this->belongsTo(LpbjItem::class);
	}
}
