<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Admin extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;
	
	protected $table = 'admin';
	protected $fillable = ['id','username','fullname','birthdate', 'address','email','created_at','updated_at','role','sex','mobile_phone','password','remember_token'];
	protected $hidden = ['password', 'remember_token'];
	protected $primaryKey = 'id';
	public $timestamps=true;
}
?>