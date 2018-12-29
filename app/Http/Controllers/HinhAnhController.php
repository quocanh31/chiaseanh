<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HinhAnh;

class HinhAnhController extends Controller
{
    //
    public function getDanhSach()
    {
    	$hinhanh=HinhAnh::orderBy('id','DESC')->get();
   		return view('admin.hinhanh.danhsach',['hinhanh'=>$hinhanh]);
 }

 	public function getXoa($id)
 	{
 		$hinhanh=HinhAnh::find($id);
 		unlink("upload/hinhanh/".$hinhanh->Hinh);
 		$hinhanh->delete();
 		return back()->with('message','Xóa Thành Công!');
 	}
}
