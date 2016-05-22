<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Product extends Model implements AuthenticatableContract
{
	use Authenticatable, CanResetPassword;

    protected $table = 'Product';
    protected $fillable = ['product_id', 'nama', 'harga', 'foto', 'created_at', 'updated_at', 'id_kategori'];
    protected $primarykey = 'product_id';
}
