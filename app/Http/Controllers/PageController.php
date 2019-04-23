<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//khai bao de do hatb slide
use App\Slide;
use App\Products;
use App\TypeProducts;

use App\Cart;
use Session;

use App\User;
use Hash;
use Auth;
class PageController extends Controller
{
	//do hinh anh tu bang slide
	public function getIndex(){
		$slide=Slide::all();
		/*Phan trang bang paginate*/
		$new_product=Products::where('new',1)->paginate(4);
		
		$sanpham_km=Products::where('promotion_price','<>',0)->paginate(8);
		
		return view('page.trangchu',compact('slide','new_product','sanpham_km'));
	}

	public function getLoaisanpham($type){
		$sp_theoloai=Products::where('id_type',$type)->get();
		$sp_khac=Products::where('id_type','<>',$type)->paginate(3);
		//
		$loai=TypeProducts::all();
		$tenloai_sp=TypeProducts::where('id',$type)->first();
		return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','tenloai_sp'));
	}
	public function getChitiet(Request $req){
		$sanpham=Products::where('id',$req->id)->first();
		//san pham tuong tu
		$sanpham_tt=Products::where('id_type',$sanpham->id_type)->paginate(3);
		return view('page.chitiet_sanpham',compact('sanpham','sanpham_tt'));
	}
	public function getLienhe(){
		return view('page.lienhe');
	}
	public function getGioithieu(){
		return view('page.gioithieu');
	}

	//addtocart
	public function getAddtoCart(Request $req,$id)
	{
		$product=Products::find($id);
		$oldCart=Session('cart')?Session::get('cart'):null;
		$cart=new Cart($oldCart);
		//them sp vao gio hang
		$cart->add($product,$id);
		$req->Session()->put('cart',$cart);
		return redirect()->back();
	}

	public function getDeleteCart($id)
	{
		$oldCart=Session::has('cart')?Session::get('cart'):null;
		$cart=new Cart($oldCart);
		$cart->removeItem($id);
		Session::put('cart',$cart); 
		return redirect()->back();
	}

	
	public function getSignin(){
		return view('page.dangky');
	}
	public function postSignin(Request $req){
		$this->validate($req,
			[
				'email'=>'required|email|unique:users,email',
				'password'=>'required|min:6|max:20',
				'fullname'=>'required',
				're_password'=>'required|same:password'
			],
			[	
				'email.required'=>'Vui lòng nhập lại email',
				'email.email'=>'Không đúng định dạng email',
				'email.unique'=>'Email đã có người sử dụng',
				'password.required'=>'Vui lòng nhập mật khẩu',
				're_password.same'=>'Mật khẩu không giống nhau',
				'password.min'=>'Mật khẩu có ít nhất 6 kí tự'
			]);
		$user=new User();
		$user->full_name=$req->fullname;
		$user->email=$req->email;
		$user->password=Hash::make($req->password);
		$user->phone=$req->phone;
		$user->address=$req->address;
		$user->save();
		return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
	}

	public function getLogin(){
		return view('page.dangnhap');
	}
	public function postLogin(Request $req){
		$this->validate($req,
			[
				'email'=>'required|email',
				'password'=>'required|min:6'
			],
			[
				'email.required'=>'Vui lòng nhập email',
				'email.email'=>'Email không đúng',
				'password.required'=>'Vui lòng nhập password',
				'password.min'=>'Mật khẩu phải ít nhất 6 kí tự'
			]
		);
		$credentials=array('email'=>$req->email,'password'=>$req->password);
		if(Auth::attempt($credentials))
		{
			return redirect()->back()->with(['flag'=>'success','message'=>'Đăng nhập thành công']);
		}
		else
			{
				return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập thất bại']);
			}
		
	}

	public function postLogout(){
		Auth::logout();
		return redirect()->route('trang-chu');
	}

	public function getIn()
	{
		return view('admin.layout.index');
	}
}
