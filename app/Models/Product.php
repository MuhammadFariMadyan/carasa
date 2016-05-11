<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Product extends Model implements AuthenticatableContract, CanResetPasswordContract
{
	use Authenticatable, CanResetPassword;
	
	protected $table = 'Product';
	protected $fillable = ['product_id','nama', 'harga', 'foto','stock','created_at','updated_at','id_kategori'];
	
	protected $primaryKey = 'product_id';
	protected $foreignKey = 'id_kategori';
	public $timestamps=true;
}
?>