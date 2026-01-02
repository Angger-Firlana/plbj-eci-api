<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vendor
 * 
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property string|null $contact_person
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $to_vendor
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Vendor extends Model
{
	protected $table = 'vendors';

	protected $fillable = [
		'name',
		'address',
		'contact_person',
		'phone',
		'email',
		'to_vendor'
	];
}
