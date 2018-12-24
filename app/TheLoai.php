<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class theloai extends Model
{
    protected $table="TheLoai";

    public function hinhanh()
    {
    	return $this->hasMany('App\HinhAnh','idTheLoai','id');
    }
}
