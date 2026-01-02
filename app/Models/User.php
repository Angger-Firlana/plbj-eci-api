<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * 
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string $pin
 * @property string|null $token
 * @property bool $is_active
 * @property string $profile_photo
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $role_id
 * 
 * @property Role $role
 * @property Collection|Approval[] $approvals
 * @property Collection|Lpbj[] $lpbjs
 * @property Collection|Position[] $positions
 *
 * @package App\Models
 */
class User extends Authenticatable
{
	use HasApiTokens, Notifiable;
	
	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'is_active' => 'bool',
		'role_id' => 'int'
	];

	protected $hidden = [
		'password',
		'token',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'pin',
		'token',
		'is_active',
		'profile_photo',
		'remember_token',
		'role_id'
	];

	public function role()
	{
		return $this->belongsTo(Role::class);
	}

	public function approvals()
	{
		return $this->hasMany(Approval::class, 'approver_id');
	}

	public function lpbjs()
	{
		return $this->hasMany(Lpbj::class, 'request_by');
	}

	public function positions()
	{
		return $this->hasMany(Position::class);
	}
}
