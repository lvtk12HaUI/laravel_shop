@extends('backend.master')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-primary txt-ct">Cập nhật danh mục sản phẩm</h5>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
              <div class="p-5">
                <form class="user" method="POST" action="{{route('handleEditCategoryProduct',$category->category_id)}}">
                  {{ csrf_field() }}
                  <div class="form-group font-style">
                    <label for="category_product_name">Tên danh mục</label>
                  <input type="text" id="category_product_name" name="category_product_name" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" required="" placeholder="Tên danh mục" value="{{$category->category_name}}">
                  @if(session('notification'))
                    <p class="notiErr">{{session('notification')}}</p>
                  @endif
                </div>
                  <div class="form-group font-style">
                    <label for="category_product_desc">Mô tả danh mục</label>
	                  <textarea style="resize: none;" name="category_product_desc" class="form-control" id="category_product_desc" rows="8" placeholder="Mô tả danh mục" required="">{{$category->category_desc}}</textarea>
                  </div>
                  <div class="form-group font-style">
                    <label for="status">Hiển thị</label>
                    <select name="status" id="status" class="form-control">
                      <option value="0" selected>Ẩn</option>
                      <option value="1" {{$checked = $category->category_status==1?'selected = ""':""}}>Hiển thị</option>
                    </select>
                  </div>
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Cập nhật danh mục">
                </form>
              </div>
            </div>
          </div>
      </div>
@endsection