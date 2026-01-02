<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class NoteQuotation
 * 
 * @property int $id
 * @property int $quotation_id
 * @property string $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Quotation $quotation
 *
 * @package App\Models
 */
class NoteQuotation extends Model
{
	protected $table = 'note_quotations';

	protected $casts = [
		'quotation_id' => 'int'
	];

	protected $fillable = [
		'quotation_id',
		'note'
	];

	public function quotation()
	{
		return $this->belongsTo(Quotation::class);
	}
}
