<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryProduct as Category;
use App\Models\BrandProduct as Brand;

class ProductController extends Controller
{
    public function viewAddProduct(){
        $categories = Category::all();
        $brands = Brand::all();
        return view("backend.pages.add_product",compact('categories','brands'));
    }

    public function viewListProduct(){
        $products = Product::all();
        return view("backend.pages.list_product",compact('products'));
    }

    public function handleAddProduct(Request $request){
        $checkProduct = Product::where('product_name',$request->product_name)->first();
        if(!empty($checkProduct)){
            return redirect()->back()->withInput()->with('notification','Sản phẩm đã tồn tại');
        }
        else{
            $data = [
                'product_name' => $request->product_name,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'product_price' => $request->product_price,
                'product_desc' => $request->product_desc,
                'product_content' => $request->product_content,
                'product_status' => $request->status
            ];  
            $check = $request->hasFile('product_image');
            if($check){
                $file = $request->product_image;
                $typeFile = $file->getClientOriginalExtension();
                if($typeFile == "jpg" || $typeFile == "png" || $typeFile == "jpeg" || $typeFile == "gif"){
                    $image = rand(0,99).'-'.$file->getClientOriginalName();
                    $data['product_image'] = $image;
                    $check = Product::create($data);
                    if($check){
                        $file->move('public/backend/uploads/product',$image);
                        return redirect()->route('viewListProduct')->with('notification','Thêm sản phẩm thành công');
                    }
                }
                else{
                    return redirect()->route('viewAddProduct')->withInput()->with('notification2','Vui lòng upload file ảnh');
                }
            }
            
        }  
    }

    public function handleDelProduct($product_id){
        if(Product::find($product_id)){
            if(Product::destroy($product_id)){
                return redirect()->route('viewListProduct')->with('notification','Xóa sản phẩm thành công');
            }
        }
        else{
            return redirect()->route('viewListProduct')->with('notification','Sản phẩm không tồn tại');   
        }
    }
}
