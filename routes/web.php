<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Theloai;
Route::get('/', 'PagesController@hienMenu');

Route::get('admin/dangnhap','UserController@getDangnhapAdmin');
Route::post('admin/dangnhap','UserController@postDangnhapAdmin');
Route::get('admin/logout','UserController@getDangXuatAdmin');

Route::group(['prefix' => 'admin','middleware' => 'adminLogin'],function(){
	Route::group(['prefix' => 'theloai'],function(){
		Route::get('danhsach','TheLoaiController@getDanhSach');
		Route::get('them','TheLoaiController@getThem');
		Route::get('sua/{id}','TheLoaiController@getSua');
		Route::post('sua/{id}','TheLoaiController@postSua');
		Route::get('xoa/{id}','TheLoaiController@getXoa');
		Route::post('them','TheLoaiController@postThem');
	});

		// Route group User
	Route::group(['prefix' => 'user'],function(){
		Route::get('danhsach','UserController@getDanhSach');
		Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');
		Route::get('sua/{id}','UserController@Sua');
		Route::post('sua/{id}','UserController@XuLySuaUser');
		Route::get('xoa/{id}','UserController@Xoa');
	});

		// Route group slide
	Route::group(['prefix' => 'slide'],function(){
		Route::get('danhsach','SlideController@getDanhSach');
		Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');
		Route::get('sua/{id}','SlideController@getSua');
		Route::post('sua/{id}','SlideController@postSua');
		Route::get('xoa/{id}','SlideController@getXoa');
	});	

});


/*
Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'hinhanh'],function(){
		Route::get('danhsach','TheLoaiController@getDanhSach');
		Route::get('sua','TheLoaiController@getSua');
		Route::get('them','TheLoaiController@getThem');
	});
});
*/

Route::get('trangchu','PagesController@hienMenu');

Route::get('gioithieu','PagesController@gioiThieu');

Route::get('dangnhap','PagesController@dangNhap');
Route::post('dangnhap','PagesController@postDangNhap');
Route::get('dangxuat','PagesController@getDangXuat');
Route::get('nguoidung','PagesController@getNguoiDung');
Route::post('nguoidung','PagesController@postNguoiDung');
Route::get('dangky','PagesController@getDangKy');
Route::post('dangky','PagesController@postDangKy');
Route::get('uphinh','PagesController@getUphinh');
Route::post('uphinh','PagesController@postUphinh');
Route::get('hinhanh/{id}/{TenKhongDau}.html','PagesController@getHinhTl');
Route::get('hinhanh/chitiet/{id}/{TenKhongDau}.html','PagesController@getHinhCt');
Route::get('timkiem','PagesController@timKiem');


Route::post('comment/{id}','CommentController@postComment');

Route::get('photo/{id}/{name}','UserPhotoController@getUserPhoto');
Route::get('photo/{id}/{name}/{tlid}','UserPhotoController@getUserPhotoCate');
Route::get('xoa/photo/{id}','UserPhotoController@xoaAnh');

Route::get('sua/photo/{id}','UserPhotoController@getSua');
Route::post('sua/photo/{id}','UserPhotoController@postSua');



/*
Route::get('thu',function(){
	//$theloai=TheLoai::find(1);
	//foreach($theloai->hinhanh as $hinhanh)
	//	{
	//		echo $hinhanh->TieuDe."<br>";
	//	}
	return view('admin.theloai.danhsach');
});
*/
