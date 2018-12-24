<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

class UserController extends Controller
{
    //
    public function getDanhSach(){
    	$user = User::all();
    	return view('admin.user.danhsach',['user' => $user]);
    }

    public function getThem(){
    	return view('admin.user.them');
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,
    		[
    			'name' => 'required|min:3|max:50',
    			'email' => 'required|email|unique:users,email',
    			'password' => 'required|min:6|max:32',
    			'repassword' => 'required|same:password'
    		],
    		[
    			'name.required' => 'Bạn chưa nhập Tên tài khoản!',
    			'name.min' => 'Tên tài khoản gồm tối thiểu 3 ký tự!',
    			'name.max' => 'Tên tài khoản không được vượt quá 50 ký tự!',
    			'email.required' => 'Bạn chưa nhập địa chỉ Email!',
    			'email.email' => 'Bạn chưa nhập đúng định dạng Email!',
    			'email.unique' => 'Địa chỉ Email đã tồn tại!',
    			'password.required' => 'Bạn chưa nhập mật khẩu!',
    			'password.min' => 'Mật khẩu gồm tối thiểu 6 ký tự!',
    			'password.max' => 'Mật khẩu không được vượt quá 32 ký tự!',
    			'repassword.required' => 'Bạn chưa xác nhận mật khẩu!',
    			'repassword.same' => 'Mật khẩu xác nhận chưa khớp với mật khẩu đã nhập!'
    		]);

    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->repassword);
    	$user->quyen = $request->usertype;
    	$user->save();
    	return redirect('admin/user/them')->with('message','Thêm Người Dùng thành công!');
    }

    public function sua($id)
    {
    	$user=User::find($id);
    	return view('admin.user.sua',['user'=>$user]);
    }

    public function XuLySuaUser(Request $request,$id){
    	$this->validate($request,
    		[
    			'name' => 'required|min:3|max:50',
    		],
    		[
    			'name.required' => 'Bạn chưa nhập Tên tài khoản!',
    			'name.min' => 'Tên tài khoản gồm tối thiểu 3 ký tự!',
    			'name.max' => 'Tên tài khoản không được vượt quá 50 ký tự!',
    		]);
    	$user = User::find($id);
    	$user->name = $request->name;
    	if($request->password !="")
    	{
    		$this->validate($request,
    		[
    			'password' => 'required|min:6|max:32',
    			'repassword' => 'required|same:password'
    		],
    		[
    			'password.required' => 'Bạn chưa nhập mật khẩu!',
    			'password.min' => 'Mật khẩu gồm tối thiểu 6 ký tự!',
    			'password.max' => 'Mật khẩu không được vượt quá 32 ký tự!',
    			'repassword.required' => 'Bạn chưa xác nhận mật khẩu!',
    			'repassword.same' => 'Mật khẩu xác nhận chưa khớp với mật khẩu đã nhập!'
    		]);
    		$user->password = bcrypt($request->repassword);
    	}
    	$user->quyen = $request->usertype;
    	$user->save();
    	return redirect('admin/user/sua/'.$id)->with('message','Thay Đổi thông tin Người Dùng thành công!');
    }    

    public function Xoa($id){
        $user = User::find($id);
        //$user->Comment()->delete();
    	$user->delete();
    	return redirect('admin/user/danhsach')->with('message','Xóa Người Dùng thành công!');
    }

    public function getDangnhapAdmin()
    {
    	return view('admin.login');
    }

    public function postDangnhapAdmin(Request $request)
    {
    	$this->validate($request,[
    		'email'=> 'required',
    		'password' =>'required|min:3|max:32'
    	],[
    		'email.required' => 'Bạn chưa nhập email',
    		'email.required' => 'Bạn chưa nhập password',
    		'password.min' => 'Password không được nhỏ hơn 3 ký tự',
    		'password.max' => 'Password có độ dài tối đa 32 ký tự'
    	]);

    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
    	{
    		return redirect('admin/theloai/danhsach');
    	}
    	else
    	{
    		return redirect('admin/dangnhap')->with('message','Sai tên tài khoản hoặc mật khẩu');

    	}
    }

    public function getDangXuatAdmin()
    {
    	Auth::logout();
    	return redirect('admin/dangnhap');
    }



}
