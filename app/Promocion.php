<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promocion extends Model
{
	 use SoftDeletes;
    protected $table = 'promocion';
    protected $dates = ['deleted_at'];

    public function unidad()
	{
		return $this->belongsTo('App\Unidad', 'unidad_id');
	}
    
    public function categoria()
	{
		return $this->belongsTo('App\Categoria', 'categoria_id');
	}
    
  
    
}
