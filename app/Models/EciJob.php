<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EciJob
 * 
 * @property int $id
 * @property int $department_id
 * @property int $job_level_id
 * @property string $name
 * @property int $head_count
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Department $department
 * @property JobLevel $job_level
 *
 * @package App\Models
 */
class EciJob extends Model
{
	protected $table = 'eci_jobs';

	protected $casts = [
		'department_id' => 'int',
		'job_level_id' => 'int',
		'head_count' => 'int'
	];

	protected $fillable = [
		'department_id',
		'job_level_id',
		'name',
		'head_count'
	];

	public function department()
	{
		return $this->belongsTo(Department::class);
	}

	public function job_level()
	{
		return $this->belongsTo(JobLevel::class);
	}
}
