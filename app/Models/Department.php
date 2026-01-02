<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Department
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|EciJob[] $eci_jobs
 * @property Collection|Lpbj[] $lpbjs
 *
 * @package App\Models
 */
class Department extends Model
{
	protected $table = 'departments';

	protected $fillable = [
		'name',
		'description',
		'code'
	];

	public function eci_jobs()
	{
		return $this->hasMany(EciJob::class);
	}

	public function lpbjs()
	{
		return $this->hasMany(Lpbj::class);
	}
}
