<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $table="Comment";

    public function hinhanh()
    {
    	return $this->belongsTo('App\HinhAnh','idHinhAnh','id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User','idUser','id');
    }
}
