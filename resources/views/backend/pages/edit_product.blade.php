@extends('backend.master')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-primary txt-ct">Cập nhật sản phẩm</h5>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
              <div class="p-5">
                <form class="user" method="POST" action="{{route('handleEditProduct',$product->product_id)}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group font-style">
                    <label for="product_name">Tên sản phẩm</label>
                    <input type="text" id="product_name" name="product_name" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" required="" placeholder="Tên sản phẩm" value="{{$product->product_name}}">
                    @if(session('notification'))
                      <p class="notiErr">{{session('notification')}}</p>
                    @endif
                  </div>
                  <div class="form-group font-style">
                    <label for="product_price">Giá sản phẩm</label>
                    <input type="number" id="product_price" name="product_price" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" required="" placeholder="Giá sản phẩm (VNĐ)" value="{{$product->product_price}}">
                  </div>
                  <div class="form-group font-style">
                    <label for="product_image">Hình ảnh</label>
                    <input type="file" id="product_image" name="product_image" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp">
                    @if(session('notification2'))
                      <p class="notiErr">{{session('notification2')}}</p>
                    @endif
                    <img src="{{'uploads/product/'.$product->product_image}}" class="mg-t-10" alt="Image error" width="100px" height="100px">
                  </div>
                  <div class="form-group font-style">
                    <label for="category_product_desc">Mô tả sản phẩm</label>
	                  <textarea style="resize: none;" name="product_desc" class="form-control" id="category_product_desc" rows="8" placeholder="Mô tả danh mục" required="">{{$product->product_desc}}</textarea>
                  </div>
                  <div class="form-group font-style">
                    <label for="category_product_desc">Nội dung sản phẩm</label>
	                  <textarea style="resize: none;" name="product_content" class="form-control" id="category_product_desc" rows="8" placeholder="Mô tả danh mục" required="">{{$product->product_content}}</textarea>
                  </div>
                  <div class="form-group font-style">
                    <label for="category_id">Danh mục sản phẩm</label>
                    <select name="category_id" id="category_id" class="form-control">
                      @foreach($categories as $key => $val)
                        <option value="{{$val->category_id}}" @if($product->category_id == $val->category_id) selected @endif>{{$val->category_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group font-style">
                    <label for="brand_id">Thương hiệu</label>
                    <select name="brand_id" id="brand_id" class="form-control">
                      @foreach($brands as $key => $val)
                        <option value="{{$val->brand_id}}" @if($product->brand_id == $val->brand_id) selected @endif>{{$val->brand_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group font-style">
                    <label for="status">Hiển thị</label>
                    <select name="status" id="status" class="form-control">
                      <option value="0" selected>Ẩn</option>
                      <option value="1" {{$checked = $product->product_status==1?'selected = ""':""}}>Hiển thị</option>
                    </select>
                  </div>
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Cập nhật sản phẩm">
                </form>
              </div>
            </div>
          </div>
      </div>
@endsection