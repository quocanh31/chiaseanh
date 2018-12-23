<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hinhanh extends Model
{
    protected $table="HinhAnh";

    public function theloai()
    {
    	return $this->belongsTo('App\TheLoai','idTheLoai','id');
    }

    public function comment()
    {
    	return $this->hasMany('App\Comment','idHinhAnh','id');
    }

    public function hauser()
    {
    	return $this->belongsTo('App\User','idUser','id');
    }


}
