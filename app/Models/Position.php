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
 * @property int $eci_job_id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property EciJob $eciJob
 * @property User $user
 *
 * @package App\Models
 */
class Position extends Model
{
	protected $table = 'positions';

	protected $casts = [
		'eci_job_id' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'eci_job_id',
		'user_id'
	];

	public function eciJob()
	{
		return $this->belongsTo(EciJob::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
