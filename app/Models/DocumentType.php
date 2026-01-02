<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DocumentType
 * 
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Approval[] $approvals
 *
 * @package App\Models
 */
class DocumentType extends Model
{
	protected $table = 'document_types';

	protected $fillable = [
		'name'
	];

	public function approvals()
	{
		return $this->hasMany(Approval::class);
	}
}
