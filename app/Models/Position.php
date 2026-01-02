<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Position
 * 
 * @property int $id
 * @property int $job_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Job $job
 * @property User $user
 *
 * @package App\Models
 */
class Position extends Model
{
	protected $table = 'positions';

	protected $casts = [
		'job_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'job_id',
		'user_id'
	];

	public function job()
	{
		return $this->belongsTo(Job::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
