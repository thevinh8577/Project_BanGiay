<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeProducts;
class TheloaiController extends Controller
{
    //
    public function getDanhSach()
    {
    	$loai=TypeProducts::all();
    	return view('admin.theloai.danhsach',['loai'=>$loai]);
    }
    public function getThem()
    {
    	return view('admin.theloai.them');
    }
    public function postThem(Request $request)
    {
    	$this->validate($request, 
    		[
    			'Ten'=>'required|min:3|unique:type_products,name'
    		],
    		[
    			'Ten.required'=>'Bạn chưa nhập loại',
    			'Ten.min'=>'Độ dài phải trên 3 ký tự',
    			'Ten.unique'=>'Loại này đã tồn tại'
    		]);

    	$theloai=new TypeProducts;
    	$theloai->name=$request->Ten;
    	$theloai->description=$request->Mota;

    	if($request->hasFile('Hinh'))
    	{
    		$file=$request->file('Hinh');

    		$duoi=$file->getClientOriginalExtension();

    		if($duoi!='jpg'&&$duoi!='png'&&   $duoi!='ipeg')
    		{
    			return redirect('admin/loai/them')->with('thongbao','Không đúng định dạng file hình');
    		}
    		//Kiem tra ten hinh
    		$name=$file->getClientOriginalName();
    		$Hinh=str_random(3)."_".$name;
    		$file->move("source/image/product",$Hinh);
    		$theloai->image=$Hinh;
    	}
    	else
    	{
    		$theloai->image=" ";
    	}
    	$theloai->save();
    	return redirect('admin/loai/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id)
    {
    	$theloai=TypeProducts::find($id);
    	return view('admin.loai.sua',['theloai'=>$theloai]);
    }
    public function postSua()
    {

    }

    public function getXoa($id)
    {	
    	$theloai=TypeProducts::find($id);
    	$theloai->delete();
    	return redirect('admin/loai/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
