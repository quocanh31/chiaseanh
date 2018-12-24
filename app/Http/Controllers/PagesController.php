<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use App\TheLoai;
use App\Slide;
use App\User;
use App\HinhAnh;


class PagesController extends Controller
{

	
	function __construct()
	{		
		$slide = Slide::orderBy('id', 'desc')->take(4)->get();
		$theloai = TheLoai::all();
		view::share(['theloai'=>$theloai, 'slides'=>$slide]);
	}
	


	public function hienMenu()
	{
		$hinhanh = HinhAnh::orderBy('created_at','desc')->paginate(12);
		return view('pages.trangchu',['hinhanh'=>$hinhanh]);
	}
	public function gioiThieu()
	{	
		return view('pages.gioithieu');
	}

	public function dangNhap()
	{	
		return view('pages.dangnhap');
	}

	public function postDangNhap(Request $request)
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
    		return redirect('trangchu');
    	}
    	else
    	{
    		return redirect('dangnhap')->with('message','Sai tên tài khoản hoặc mật khẩu');

    	}    	

	}

	public function getDangXuat()
	{
    	Auth::logout();
    	return redirect('trangchu');		
	}

	public function getNguoiDung()
	{
		$user = Auth::user();
		return view('pages.nguoidung',['user'=>$user]);
	}

	public function postNguoiDung(Request $request)
	{
    	$this->validate($request,
    		[
    			'username' => 'required|min:3|max:50',
    		],
    		[
    			'username.required' => 'Bạn chưa nhập Tên tài khoản!',
    			'username.min' => 'Tên tài khoản gồm tối thiểu 3 ký tự!',
    			'username.max' => 'Tên tài khoản không được vượt quá 50 ký tự!',
    		]);
    	$user = Auth::user();
    	$user->name = $request->username;
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
    	$user->save();
    	return redirect('nguoidung')->with('message','Cập nhật thông tin thành công!');
	}

	public function getDangKy()
	{
		return view('pages.dangky');
	}

	public function postDangKy(Request $request)
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
    	$user->quyen = 0;
    	$user->save();
    	return redirect('dangky')->with('message','Đăng ký thành công, vui lòng đăng nhập!');
	}

	public function getUphinh()
	{
		return view('pages.uphinh');
	}

	public function postUphinh(Request $request)
	{
	$this->validate($request,[
	    		'txtCateName' => 'required|min:3|max:50',
	    		'NoiDung'=> 'required'
	    	],[
	    		'txtCateName.required' =>'Bạn chưa nhập tên',
	    		'txtCateName.min' => 'Tên gồm tối thiểu 3 ký tự!',
    			'txtCateName.max' => 'Tên không được vượt quá 50 ký tự!',
	    		'NoiDung.required' => 'Bạn chưa nhập nội dung'
	    	]);
	    	$hinhanh=new HinhAnh;
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
	    		$img_file->move('upload/hinhanh',$random_file_name); // file hình được upload sẽ chuyển vào thư mục có đường dẫn như trên
	    		$hinhanh->Hinh = $random_file_name;
	    	}
	    	else
	    		return redirect('uphinh')->with('error','Bạn chưa up ảnh!');

	    	$hinhanh->idTheLoai=$request->idtheloai;
	    	$hinhanh->idUser=Auth::user()->id;
	    	$hinhanh->TieuDeKhongDau = str_slug($request->txtCateName,'-');	
			

	    	$hinhanh->save();
	    	return redirect('uphinh')->with('message','Up hình thành công!');		
	}

	public function getHinhTl($id)
	{	
			$tentl =TheLoai::find($id);
			$hinhanh = HinhAnh::where('idTheLoai',$id)->orderBy('created_at','desc')->paginate(12);	
			return view('pages.hatheloai',['hinhanh'=>$hinhanh,'tentl'=>$tentl]);	
	}

	public function getHinhCt($id)
	{
		$hinhanh= HinhAnh::find($id);
		$hinhanh->SoLuotXem+=1;
		if($hinhanh->SoLuotXem == 10)
		{
			$hinhanh->NoiBat=1;
		}
		$nguoidang= User::find($hinhanh->idUser);
		$hinhanh->save();
		$hinhNoiBat= HinhAnh::where('NoiBat',1)->take(4)->get();
		$hinhLienQuan=HinhAnh::where('idUser',$hinhanh->idUser)->take(4)->get();
		return view('pages.chitiet',['hinhanh'=>$hinhanh,'hinhNoiBat'=>$hinhNoiBat,'hinhLienQuan'=>$hinhLienQuan
			,'nguoidang'=>$nguoidang]);
	}

	public function timKiem(Request $request)
	{
		$tukhoa= $request->tukhoa;
		$hinhanh = HinhAnh::where('TieuDe','like','%'.$tukhoa.'%')->orWhere('NoiDung','like','%'.$tukhoa.'%')->paginate(12);
		return view('pages.timkiem',['tukhoa'=>$tukhoa,'hinhanh'=>$hinhanh]);
	}
}
