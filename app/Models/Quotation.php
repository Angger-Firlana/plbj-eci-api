<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Quotation
 * 
 * @property int $id
 * @property int $lpbj_id
 * @property string $quotation_number
 * @property Carbon $quotation_date
 * @property string $pr_no
 * @property string $description
 * @property string $frenco
 * @property string $pkp
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Lpbj $lpbj
 * @property Collection|NoteQuotation[] $note_quotations
 * @property Collection|PurchasedOrder[] $purchased_orders
 * @property Collection|QuotationDetail[] $quotation_details
 *
 * @package App\Models
 */
class Quotation extends Model
{
	protected $table = 'quotations';

	protected $casts = [
		'lpbj_id' => 'int',
		'quotation_date' => 'datetime'
	];

	protected $fillable = [
		'lpbj_id',
		'quotation_number',
		'quotation_date',
		'pr_no',
		'description',
		'frenco',
		'pkp',
		'status'
	];

	public function lpbj()
	{
		return $this->belongsTo(Lpbj::class);
	}

	public function note_quotations()
	{
		return $this->hasMany(NoteQuotation::class);
	}

	public function purchased_orders()
	{
		return $this->hasMany(PurchasedOrder::class);
	}

	public function quotation_details()
	{
		return $this->hasMany(QuotationDetail::class);
	}
}
