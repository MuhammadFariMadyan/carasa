<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DummyProduct extends Model
{
    protected $table = 'product';
    protected $fillable = ['product_id', 'nama', 'harga', 'foto', 'created_at', 'updated_at', 'id_kategori'];
    protected $primarykey = 'product_id';
}