<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slide;

class SlideController extends Controller
{
    //
    public function getDanhSach(){
    	$slide = Slide::all();
    	return view('admin.slide.danhsach',['slide'=>$slide]);
    }

    public function postThem(Request $request)
    {
    	$this->validate($request,[
    		'name' => 'required',
    		'NoiDung'=> 'required'
    	],[
    		'name.required' =>'Bạn chưa nhập tên',
    		'NoiDung.required' => 'Bạn chưa nhập nội dung'
    	]);
    	$slide=new Slide;
    	$slide->Ten=$request->name;
    	$slide->NoiDung=$request->NoiDung;
    	if($request->has('link'))
    		$slide->link=$request->link;
	
    	if($request->hasFile('hinh')) // Kiểm tra xem người dùng có upload hình hay không
    	{
    		$img_file = $request->file('hinh'); // Nhận file hình ảnh người dùng upload lên server
    		
    		$img_file_extension = $img_file->getClientOriginalExtension(); // Lấy đuôi của file hình ảnh
    		if($img_file_extension != 'png' && $img_file_extension != 'jpg' && $img_file_extension != 'jpeg' &&$img_file_extension != 'gif')
    		{
    			return redirect('admin/slide/them')->with('error','Định dạng hình ảnh không hợp lệ (chỉ hỗ trợ các định dạng: gif, png, jpg, jpeg)!');
    		}
    		$img_file_name = $img_file->getClientOriginalName(); // Lấy tên của file hình ảnh
    		$random_file_name = str_random(4).'_'.$img_file_name; // Random tên file để tránh trường hợp trùng với tên hình ảnh khác trong CSDL
    		while(file_exists('upload/slide/'.$random_file_name)) // Trường hợp trên gán với 4 ký tự random nhưng vẫn có thể xảy ra trường hợp bị trùng, nên bỏ vào vòng lặp while để kiểm tra với tên tất cả các file hình trong CSDL, nếu bị trùng thì sẽ random 1 tên khác đến khi nào ko trùng nữa thì thoát vòng lặp
    		{
    			$random_file_name = str_random(4).'_'.$img_file_name;
    		}
    		echo $random_file_name;
    		$img_file->move('upload/slide',$random_file_name); // file hình được upload sẽ chuyển vào thư mục có đường dẫn như trên
    		$slide->Hinh = $random_file_name;
    	}
    	else
    		$slide->Hinh = ''; // Nếu người dùng không upload hình thì sẽ gán đường dẫn là rỗng
		

    	$slide->save();
    	return redirect('admin/slide/them')->with('message','Thêm Slide thành công!');

    }

    public function getThem()
    {
    	return view('admin.slide.them');
    }

    public function getSua($id)
    {
    	$slide=Slide::find($id);
    	return view('admin.slide.sua',['slide'=>$slide]);
    }

    public function postSua(Request $request,$id)
    {
    	$this->validate($request,[
    		'name' => 'required',
    		'NoiDung'=> 'required'
    	],[
    		'name.required' =>'Bạn chưa nhập tên',
    		'NoiDung.required' => 'Bạn chưa nhập nội dung'
    	]);
    	$slide= Slide::find($id);
    	$slide->Ten=$request->name;
    	$slide->NoiDung=$request->NoiDung;
    	if($request->has('link'))
    		$slide->link=$request->link;
	
    	if($request->hasFile('hinh')) // Kiểm tra xem người dùng có upload hình hay không
    	{
    		$img_file = $request->file('hinh'); // Nhận file hình ảnh người dùng upload lên server
    		
    		$img_file_extension = $img_file->getClientOriginalExtension(); // Lấy đuôi của file hình ảnh
    		if($img_file_extension != 'png' && $img_file_extension != 'jpg' && $img_file_extension != 'jpeg' &&$img_file_extension != 'gif')
    		{
    			return redirect('admin/slide/sua/'.$id)->with('error','Định dạng hình ảnh không hợp lệ (chỉ hỗ trợ các định dạng: gif, png, jpg, jpeg)!');
    		}
    		$img_file_name = $img_file->getClientOriginalName(); // Lấy tên của file hình ảnh
    		$random_file_name = str_random(4).'_'.$img_file_name; // Random tên file để tránh trường hợp trùng với tên hình ảnh khác trong CSDL
    		while(file_exists('upload/slide/'.$random_file_name)) // Trường hợp trên gán với 4 ký tự random nhưng vẫn có thể xảy ra trường hợp bị trùng, nên bỏ vào vòng lặp while để kiểm tra với tên tất cả các file hình trong CSDL, nếu bị trùng thì sẽ random 1 tên khác đến khi nào ko trùng nữa thì thoát vòng lặp
    		{
    			$random_file_name = str_random(4).'_'.$img_file_name;
    		}
    		echo $random_file_name;
    		unlink("upload/slide/".$slide->Hinh);
    		$img_file->move('upload/slide',$random_file_name); // file hình được upload sẽ chuyển vào thư mục có đường dẫn như trên
    		$slide->Hinh = $random_file_name;
    	}

		

    	$slide->save();
    	return redirect('admin/slide/sua/'.$id)->with('message','Sửa Slide thành công!');
    }

    public function getXoa($id)
    {
        $slide = Slide::find($id);
    	$slide->delete();
    	return redirect('admin/slide/danhsach')->with('message','Xóa thành công!');   	
    }
}
