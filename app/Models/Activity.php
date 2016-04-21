<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
	protected $table = 'activity_report';
	protected $fillable = ['kode','id','action','created_at','updated_at'];
	protected $primaryKey = 'id';
	public $timestamps=true;
}
?>