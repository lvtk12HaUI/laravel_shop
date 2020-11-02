<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BrandProduct as Brand;

class BrandProductController extends Controller
{

    public function viewAddBrandProduct(){
        return view('backend.pages.add_brand_product');
    }

    public function viewListBrandProduct(){
        $brands = Brand::all();
        return view('backend.pages.list_brand_product',compact('brands'));
    }

    public function viewEditBrandProduct($brand_id){
        $brand = brand::find($brand_id);
        if($brand){
            return view('backend.pages.edit_brand_product',compact('brand'));
        }
        else{
            return redirect()->route('viewListBrandProduct')->with('notification','Thương hiệu không tồn tại');
        }   
    }

    public function handleAddBrandProduct(Request $request){
        $checkbrand = brand::where('brand_name',$request->brand_product_name)->first();
        if($checkbrand){
            return redirect()->back()->withInput()->with('notification','Thương hiệu đã tồn tại');
        }
        else{
            $data = [
                'brand_name' => $request->brand_product_name,
                'brand_desc' => $request->brand_product_desc,
                'brand_status' => $request->status,
            ];
            if(brand::create($data)){
               return redirect()->route("viewListBrandProduct")->with("notification","Thêm thương hiệu thành công");
            }
        }
    }

    public function handleDelBrandProduct($brand_id){
        if(Brand::find($brand_id)){
            if(brand::destroy($brand_id)){
                return redirect()->route('viewListBrandProduct')->with('notification','Xóa thương hiệu thành công');
            }
        }
        else{
            return redirect()->route('viewListBrandProduct')->with('notification','Thương hiệu không tồn tại');
        }
    }

    public function handleEditbrandProduct(Request $request, $brand_id){
        $data = $request->all();
        $checkbrand = brand::where('brand_name',$data['brand_product_name'])->first();

        if($checkbrand && $checkbrand->brand_name != $data['brand_product_name']){
            return redirect()->back()->with('notification','Tên danh mục đã tồn tại');
        }
        else{
            if(brand::where('brand_id',$brand_id)->update([
                'brand_name'=>$data['brand_product_name'],
                'brand_desc'=>$data['brand_product_desc'],
                'brand_status' => $data['status']
                ])
            ){
                return redirect()->route('viewListBrandProduct')->with('notification','Cập nhật thương hiệu thành công');
            }
        }
    }

}
