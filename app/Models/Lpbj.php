<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lpbj
 * 
 * @property int $id
 * @property int $request_by
 * @property int $lpbj_number
 * @property int $department_id
 * @property Carbon $request_date
 * @property int $store_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Department $department
 * @property User $user
 * @property Store $store
 * @property Collection|LpbjItem[] $lpbj_items
 * @property Collection|Quotation[] $quotations
 *
 * @package App\Models
 */
class Lpbj extends Model
{
	protected $table = 'lpbjs';

	protected $casts = [
		'title' => 'string',
		'request_by' => 'int',
		'lpbj_number' => 'int',
		'department_id' => 'int',
		'request_date' => 'datetime',
		'store_id' => 'int'
	];

	protected $fillable = [
		'title',
		'request_by',
		'lpbj_number',
		'department_id',
		'request_date',
		'store_id'
	];

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'request_by');
	}

	public function store()
	{
		return $this->belongsTo(Store::class);
	}

	public function lpbj_items()
	{
		return $this->hasMany(LpbjItem::class);
	}

	public function quotations()
	{
		return $this->hasMany(Quotation::class);
	}
}
