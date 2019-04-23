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

Route::get('/', function () {
    return view('welcome');
});
Route::get('a', function () {
    echo "xin chao";
});



//Hien thi
Route::get('index',['as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]); 

Route::get('database',function(){
	Schema::create('loaisanphamtest',function($table){
		$table->increments('id');
		$table->string('ten',200);
	});
	echo "tao bang xong";
});


//Chay Loai_sanpham

Route::get('loaisanpham/{type}',['as'=>'loai-san-pham',
	'uses'=>'PageController@getLoaisanpham'
]); 
Route::get('chitietsanpham/{id}',['as'=>'chi-tiet-san-pham',
	'uses'=>'PageController@getChitiet'
]);
Route::get('lienhe',['as'=>'lien-he',
	'uses'=>'PageController@getLienhe'
]); 

//Route::get('gioithieu','PageController@getGioithieu');
Route::get('gioithieu',['as'=>'gioi-thieu',
	'uses'=>'PageController@getGioithieu'
]); 

Route::get('add-to-cart/{id}',['as'=>'themgiohang', 'uses'=> 'PageController@getAddtoCart']);
Route::get('delete-cart/{id}',['as'=>'xoagiohang','uses'=>'PageController@getDeleteCart']);

Route::get('dang-nhap',['as'=>'login','uses'=>'PageController@getLogin']);
Route::get('dang-nhap',['as'=>'login','uses'=>'PageController@postLogin']);

Route::get('dang-ky',['as'=>'signin','uses'=>'PageController@getSignin']);
// dang ky tai khoan
Route::post('dang-ky',['as'=>'signin','uses'=>'PageController@postSignin']);
//dang xuat
Route::post('dang-xuat',['as'=>'logout','uses'=>'PageController@postLogout']);

//admin dang nhap
Route::get('in',function(){return view('admin.layout.index');});


use App\TypeProducts;
Route::get('admin/dangnhap','UserController@getDangnhapAdmin');
//nhan thong tin dang nhap
Route::post('admin/dangnhap','UserController@postDangnhapAdmin');
Route::get('admin/logout','UserController@DangxuatAdmin');

Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'loai'],function(){
		//admin/loai/them
		Route::get('danhsach','TheloaiController@getDanhSach');
		Route::get('sua/{id}','TheloaiController@getSua');
		Route::get('them','TheloaiController@getThem');

		Route::get('sua/{id}','TheloaiController@postSua');
		Route::post('them','TheloaiController@postThem');

		Route::get('xoa/{id}','TheloaiController@getXoa');
	});

	Route::group(['prefix'=>'sanpham'],function(){
		Route::get('danhsach','SanphamController@getDanhSach');
		Route::get('sua','SanphamController@getSua');
		Route::get('them','SanphamController@getThem');
	});

	Route::group(['prefix'=>'user'],function(){
		Route::get('danhsach','UserController@getDanhSach');
		Route::get('sua','UserController@getSua');
		Route::get('them','UserController@getThem');
	});

	Route::group(['prefix'=>'comment'],function(){
		Route::get('danhsach','CommentController@getDanhSach');
		Route::get('sua','CommentController@getSua');
		Route::get('them','CommentController@getThem');
	});
	
	Route::group(['prefix'=>'loaitin'],function(){
		Route::get('danhsach','LoaiTinController@getDanhSach');
		Route::get('sua','LoaiTinController@getSua');
		Route::get('them','LoaiTinController@getThem');
	});

	Route::group(['prefix'=>'slide'],function(){
		Route::get('danhsach','SlideController@getDanhSach');
		Route::get('sua','SlideController@getSua');
		Route::get('them','SlideController@getThem');
	});
////////////////////////////////////////////////////////////////
	Route::group(['prefix'=>'admins'],function(){
		Route::group(['prefix'=>'theloai'],function(){
			Route::get('danhsach','SlideController@getDanhSach');
			Route::get('sua','SlideController@getSua');
			Route::get('them','SlideController@getThem');
		});
	});
});