<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = ['product_id', 'nama', 'harga', 'foto', 'created_at', 'updated_at', 'id_kategori'];
    protected $primarykey = 'product_id';
}
