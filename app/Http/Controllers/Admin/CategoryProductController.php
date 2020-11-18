<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct as Category;

class CategoryProductController extends Controller
{
    
    public function viewAddCategoryProduct(){
        return view('backend.pages.add_category_product');
    }

    public function viewListCategoryProduct(){
        $categories = Category::all();
        return view('backend.pages.list_category_product',compact('categories'));
    }

    public function viewEditCategoryProduct($category_id){
        $category = Category::find($category_id);
        if($category){
            return view('backend.pages.edit_category_product',compact('category'));
        }
        else{
            return redirect()->route('viewListCategoryProduct')->with('notification','Danh mục không tồn tại');
        }   
    }

    public function handleAddCategoryProduct(Request $request){
        $checkCategory = Category::where('category_name',$request->category_product_name)->first();
        if($checkCategory){
            return redirect()->back()->withInput()->with('notification','Danh mục đã tồn tại');
        }
        else{
            $data = [
                'category_name' => $request->category_product_name,
                'category_desc' => $request->category_product_desc,
                'category_status' => $request->status,
            ];
            if(Category::create($data)){
               return redirect()->route("viewListCategoryProduct")->with("notification","Thêm danh mục thành công");
            }
        }
    }

    public function handleDelCategoryProduct($category_id){
        if(Category::find($category_id)){
            if(Category::find($category_id)->products){
                return redirect()->back()->with('notification','Danh mục có sản phẩm không thể xóa');
                
            }
            else{
                if(Category::destroy($category_id)){
                    return redirect()->route('viewListCategoryProduct')->with('notification','Xóa danh mục thành công');
                }
            }
        }
        else{
            return redirect()->route('viewListCategoryProduct')->with('notification','Danh mục không tồn tại');
        }
    }

    public function handleEditCategoryProduct(Request $request, $category_id){
        $data = $request->all();
        $category_name_old = Category::find($category_id)->category_name;
        $checkCategory = Category::where('category_name',$data['category_product_name'])->first();
        if($checkCategory && $category_name_old != $data['category_product_name']){
            return redirect()->back()->with('notification','Tên danh mục đã tồn tại');
        }
        else{
            Category::where('category_id',$category_id)->update([
                'category_name'=>$data['category_product_name'],
                'category_desc'=>$data['category_product_desc'],
                'category_status' => $data['status']
            ]);
            return redirect()->route('viewListCategoryProduct')->with('notification','Cập nhật danh mục thành công');
        }
    }

}
