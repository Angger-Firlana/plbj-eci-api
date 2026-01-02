<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Store
 * 
 * @property int $id
 * @property string $store_code
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $phone
 * @property string $email
 * @property string $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|LpbjItem[] $lpbj_items
 * @property Collection|Lpbj[] $lpbjs
 * @property Collection|PurchasedOrder[] $purchased_orders
 *
 * @package App\Models
 */
class Store extends Model
{
	protected $table = 'stores';

	protected $fillable = [
		'store_code',
		'name',
		'address',
		'city',
		'phone',
		'email',
		'is_active'
	];

	public function lpbj_items()
	{
		return $this->hasMany(LpbjItem::class);
	}

	public function lpbjs()
	{
		return $this->hasMany(Lpbj::class);
	}

	public function purchased_orders()
	{
		return $this->hasMany(PurchasedOrder::class);
	}
}
