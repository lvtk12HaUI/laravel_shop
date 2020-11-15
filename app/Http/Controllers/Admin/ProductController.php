<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryProduct as Category;
use App\Models\BrandProduct as Brand;
use File;  

class ProductController extends Controller
{
    public function viewAddProduct(){
        $categories = Category::where('category_status',1)->get();
        $brands = Brand::where('brand_status',1)->get();
        return view("backend.pages.add_product",compact('categories','brands'));
    }

    public function viewListProduct(){
        $products = Product::all();
        return view("backend.pages.list_product",compact('products'));
    }

    public function viewEditProduct($product_id){
        $categories = Category::where('category_status',1)->get();
        $brands = Brand::where('brand_status',1)->get();
        $product = Product::find($product_id);
        if($product){
            return view('backend.pages.edit_product',compact('product','categories','brands'));
        }
        else{
            return redirect()->route('viewListProduct')->with('notification','Sản phẩm không tồn tại');
        }   
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
        $check = Product::find($product_id);
        if($check){
            File::delete('public/backend/uploads/product/'.$check->product_image);
            if(Product::destroy($product_id)){
                return redirect()->route('viewListProduct')->with('notification','Xóa sản phẩm thành công');
            }
        }
        else{
            return redirect()->route('viewListProduct')->with('notification','Sản phẩm không tồn tại');   
        }
    }

    public function handleEditProduct(Request $request, $product_id){
        $data = $request->all();
        $product_name_old = Product::find($product_id)->product_name;
        $checkProduct = Product::where('product_name',$data['product_name'])->first();
        if($checkProduct && $product_name_old != $data['product_name']){
            return redirect()->back()->with('notification','Tên sản phẩm đã tồn tại');
        }
        else{
            $check = $request->hasFile('product_image');
            if($check){
                $file = $request->product_image;
                $typeFile = $file->getClientOriginalExtension();
                if($typeFile == "jpg" || $typeFile == "png" || $typeFile == "jpeg" || $typeFile == "gif"){
                    $image = rand(0,99).'-'.$file->getClientOriginalName();
                    $check = Product::where('product_id',$product_id)->update(['product_image'=>$image]);
                    if($check){
                        File::delete('public/backend/uploads/product/'.$checkProduct->product_image);
                        $file->move('public/backend/uploads/product',$image);
                    }
                }
                else{
                    return redirect()->route('viewEditProduct',['product_id',$product_id])->withInput()->with('notification2','Vui lòng upload file ảnh');
                }
            }
            Product::where('product_id',$product_id)->update([
                'product_name'=>$data['product_name'],
                'product_price'=>$data['product_price'],
                'product_desc'=>$data['product_desc'],
                'product_content'=>$data['product_content'],
                'category_id'=>$data['category_id'],
                'brand_id'=>$data['brand_id'],
                'product_status' => $data['status']
                ]);
            return redirect()->route('viewListProduct')->with('notification','Cập nhật sản phẩm thành công');
        }
    }
}
