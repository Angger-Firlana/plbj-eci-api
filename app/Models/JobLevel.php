<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class JobLevel
 * 
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|EciJob[] $eci_jobs
 *
 * @package App\Models
 */
class JobLevel extends Model
{
	protected $table = 'job_levels';

	protected $fillable = [
		'name',
		'description'
	];

	public function eci_jobs()
	{
		return $this->hasMany(EciJob::class);
	}
}
