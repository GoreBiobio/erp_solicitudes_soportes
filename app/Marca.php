<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class marca extends Model
{		
	public $timestamps = false;
    public function modelos()
    { 
        return $this->hasMany('App\modelo', 'foreign_key', 'marcas_idMarca');
    }
}
