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
    public function getUserPhotoCate($id,$name,$tlid)
    {
    	$theloai= TheLoai::find($tlid);

    	$hinhanh = HinhAnh::where('idTheLoai',$theloai->id)->Where('idUser',Auth::user()->id)->paginate(12);
    	return view('pages.userPhoto',['hinhanh'=> $hinhanh]);
    
    }

    public function xoaAnh($id)
    {
    	$ha= HinhAnh::find($id);
    	unlink("upload/hinhanh/".$ha->Hinh);
    	$ha->delete();
    	$hinhanh= HinhAnh::where('idUser',Auth::user()->id)->paginate(12);
		return back()->with('message','Xóa Ảnh thành công!');


    }

    public function getSua($id)
    {
    	$ha=HinhAnh::find($id);
    	return view('pages.suaanh',['hinhanh'=>$ha]);
    }

    public function postSua($id,Request $request)
    {
    	$hinhanh=HinhAnh::find($id);
		$this->validate($request,[
	    		'txtCateName' => 'required|min:3|max:50',
	    		'NoiDung'=> 'required'
	    	],[
	    		'txtCateName.required' =>'Bạn chưa nhập tên',
	    		'txtCateName.min' => 'Tên gồm tối thiểu 3 ký tự!',
    			'txtCateName.max' => 'Tên không được vượt quá 50 ký tự!',
	    		'NoiDung.required' => 'Bạn chưa nhập nội dung'
	    	]);
	    	$hinhanh->TieuDe=$request->txtCateName;
	    	$hinhanh->NoiDung=$request->NoiDung;
		
	    	if($request->hasFile('hinh')) // Kiểm tra xem người dùng có upload hình hay không
	    	{
	    		$img_file = $request->file('hinh'); // Nhận file hình ảnh người dùng upload lên server
	    		
	    		$img_file_extension = $img_file->getClientOriginalExtension(); // Lấy đuôi của file hình ảnh
	    		if($img_file_extension != 'png' && $img_file_extension != 'jpg' && $img_file_extension != 'jpeg' &&$img_file_extension != 'gif')
	    		{
	    			return redirect('uphinh')->with('error','Định dạng hình ảnh không hợp lệ (chỉ hỗ trợ các định dạng: gif, png, jpg, jpeg)!');
	    		}
	    		$img_file_name = $img_file->getClientOriginalName(); // Lấy tên của file hình ảnh
	    		$random_file_name = str_random(4).'_'.$img_file_name; // Random tên file để tránh trường hợp trùng với tên hình ảnh khác trong CSDL
	    		while(file_exists('upload/hinhanh/'.$random_file_name)) // Trường hợp trên gán với 4 ký tự random nhưng vẫn có thể xảy ra trường hợp bị trùng, nên bỏ vào vòng lặp while để kiểm tra với tên tất cả các file hình trong CSDL, nếu bị trùng thì sẽ random 1 tên khác đến khi nào ko trùng nữa thì thoát vòng lặp
	    		{
	    			$random_file_name = str_random(4).'_'.$img_file_name;
	    		}
	    		echo $random_file_name;
	    		unlink("upload/hinhanh/".$hinhanh->Hinh);
	    		$img_file->move('upload/hinhanh',$random_file_name); // file hình được upload sẽ chuyển vào thư mục có đường dẫn như trên
	    		$hinhanh->Hinh = $random_file_name;
	    	}

	    	$hinhanh->idTheLoai=$request->idtheloai;
	    	$hinhanh->idUser=Auth::user()->id;
	    	$hinhanh->TieuDeKhongDau = str_slug($request->txtCateName,'-');	  
	    	$hinhanh->save();
	    	return back()->with('message','Sửa thành công!');

    }
/*
    public function xoaAnh($id)
    {
    	$ha = HinhAnh::find($id);
    	echo $ha->Ten;
        //$user->Comment()->delete();
        /*
    	$ha->delete();
    	$hinhanh= HinhAnh::where('idUser',$id)->paginate(12);
		return redirect('pages.userPhoto',['hinhanh'=> $hinhanh])->with('message','Xóa Ảnh thành công!');  
		

    }
    */
}
