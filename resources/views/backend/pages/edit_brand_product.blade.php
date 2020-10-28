@extends('backend.master')
@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h5 class="m-0 font-weight-bold text-primary txt-ct">Cập nhật thương hiệu sản phẩm</h5>
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
              <div class="p-5">
                <form class="user" method="POST" action="{{route('handleEditBrandProduct',$brand->brand_id)}}">
                  {{ csrf_field() }}
                  <div class="form-group font-style">
                    <label for="brand_product_name">Tên thương hiệu</label>
                  <input type="text" id="brand_product_name" name="brand_product_name" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" required="" placeholder="Tên thương hiệu" value="{{$brand->brand_name}}">
                  @if(session('notification'))
                    <p class="notiErr">{{session('notification')}}</p>
                  @endif
                </div>
                  <div class="form-group font-style">
                    <label for="brand_product_desc">Mô tả thương hiệu</label>
	                  <textarea style="resize: none;" name="brand_product_desc" class="form-control" id="brand_product_desc" rows="8" placeholder="Mô tả thương hiệu" required="">{{$brand->brand_desc}}</textarea>
                  </div>
                  <div class="form-group font-style">
                    <label for="status">Hiển thị</label>
                    <select name="status" id="status" class="form-control">
                      <option value="0" selected>Ẩn</option>
                      <option value="1" {{$checked = $brand->brand_status==1?'selected = ""':""}}>Hiển thị</option>
                    </select>
                  </div>
                  <input type="submit" class="btn btn-primary btn-user btn-block" value="Cập nhật thương hiệu">
                </form>
              </div>
            </div>
          </div>
      </div>
@endsection