<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Approval
 * 
 * @property int $id
 * @property string $document_type
 * @property int $document_id
 * @property int $approver_id
 * @property string $status
 * @property Carbon|null $approved_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Approval extends Model
{
	protected $table = 'approvals';

	protected $casts = [
		'document_id' => 'int',
		'approver_id' => 'int',
		'approved_at' => 'datetime'
	];

	protected $fillable = [
		'document_type',
		'document_id',
		'approver_id',
		'status',
		'approved_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'approver_id');
	}

	public function document(){
		return $this->morphTo([
			'name' => 'document',
			'type' => 'document_type',
			'id' => 'document_id'
		]);
	}
}
