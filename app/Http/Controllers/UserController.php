<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function getDangnhapAdmin()
    {
    	return view('admin.login');
    }
    public function postDangnhapAdmin(Request $request)
    {
    	$this->validate($request,[
    			'email'=>'required',
    			'password'=>'required|min:3'
    		],
    		[
    			'email.required'=>'Bạn chưa nhập Email',
    			'password.required'=>'Bạn chưa nhập Password',
    			'password.min'=>'Password không được nhỏ hơn 3 ký tự'
    		]);
    	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
    	{
    		return redirect('admin/loai/danhsach');
    	}
    	else{
    		return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
    	}

    }
    public function DangxuatAdmin()
    {
    	Auth::logout();
    	return redirect('admin/dangnhap');
    }
}
