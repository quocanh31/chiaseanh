<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\TheLoai;
use App\Slide;
use App\User;
use App\HinhAnh;

class UserPhotoController extends Controller
{
    //
    	function __construct()
	{		
		$slide = Slide::orderBy('id', 'desc')->take(4)->get();
		$theloai = TheLoai::all();
		view::share(['theloai'=>$theloai, 'slides'=>$slide]);
	}

    public function getUserPhoto($id)
    {
		$hinhanh= HinhAnh::where('idUser',$id)->paginate(12);
		return view('pages.userPhoto',['hinhanh'=> $hinhanh]);   	
    }
}
