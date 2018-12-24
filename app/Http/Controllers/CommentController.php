<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\TheLoai;
use App\Slide;
use App\User;
use App\HinhAnh;
use App\Comment;

class CommentController extends Controller
{
    //
    public function postComment($id, Request $request)
    {
       	$idHinh=$id;
    	$hinhanh= HinhAnh::find($id);
    	$comment =new Comment;
    	$comment->idHinhAnh=$idHinh;
    	$comment->idUser=Auth::user()->id;
    	$comment->NoiDung=$request->noidung;
    	$comment->save();

    	return redirect("hinhanh/chitiet/$id/".$hinhanh->TieuDeKhongDau.".html");
    }
    /*

    	*/
}
