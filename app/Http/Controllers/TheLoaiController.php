<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'Ten'=>'required|unique:TheLoai,Ten|min:3|max:20'
    			// Unique: Dữ liệu nhập vào không được trùng với dữ liệu hiện tại
    			// Cú pháp của unique:tên_bảng,tên_cột
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập tên Thể Loại!',
    			'Ten.unique' => 'Tên Thể Loại đã tồn tại, vui lòng nhập lại!',
    			'Ten.min'=>'Tên Thể Loại gồm ít nhất 3 ký tự!',
    			'Ten.max'=>'Tên Thể Loại gồm tối đa 20 ký tự!'
    		]);
    	// Thêm dữ liệu vào CSDL, ở đây 1 record dữ liệu được xem như một đối tượng (object), vì ta sử dụng Eloquent nên tất cả các bảng trong CSDL đã được ánh xạ thành Model trong Laravel. Do đó dữ liệu mới được thêm vào bằng cách tạo 1 đối tượng mới.
    	$theloai = new TheLoai;
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = str_slug($request->Ten,'-');
    	$theloai->save();
    	return redirect('admin/theloai/them')->with('message','Đã thêm Thể Loại!');
    }

    public function getThem()
    {
    	return view('admin.theloai.them');
    }

    public function getSua($id)
    {
    	$theloai = TheLoai::find($id);
    	return view('admin.theloai.sua',['theloai'=>$theloai]);
    }

    public function postSua(Request $request,$id)
    {
    	$theloai = TheLoai::find($id);
    	$this->validate($request,
    		[
    			'Ten' => 'required|unique:TheLoai,Ten|min:3|max:20'
    		],
    		[
    			'Ten.required' => 'Bạn chưa nhập tên Thể Loại!',
    			'Ten.unique' => 'Tên Thể Loại đã tồn tại, vui lòng nhập lại!!',
    			'Ten.min' => 'Tên Thể Loại gồm ít nhất 3 ký tự!',
    			'Ten.max' => 'Tên Thể Loại gồm tối đa 20 ký tự!'
    		]);
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = str_slug($request->Ten,'-');
    	$theloai->save();
    	return redirect('admin/theloai/sua/'.$id)->with('message','Cập nhật tên Thể Loại thành công');
    }

    public function getXoa($id)
    {
    	$theloai = TheLoai::find($id);
    	$theloai->delete();

    	return redirect('admin/theloai/danhsach')->with('message','Đã xóa thành công');
    }
}
