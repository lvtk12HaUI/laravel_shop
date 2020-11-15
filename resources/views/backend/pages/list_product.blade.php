@extends('backend.master')
@section('content')
  @push('styles')
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  @endpush

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary txt-ct">Liệt kê sản phẩm</h5>
    </div>
    @if(session('notification'))
		<div class="alert alert-success mg-l-10 notification">
			<strong>{{session('notification')}}</strong>
		</div>
    @endif
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="w-1 bd-r-none">STT</th>
              <th class="w-3 bd-r-none">Tên sản phẩm</th>
              <th class="w-2 bd-r-none">Giá</th>
              <th class="w-2 bd-r-none">Hình ảnh</th>
              <th class="w-2 bd-r-none">Danh mục</th>
              <th class="w-2 bd-r-none">Thương hiệu</th>
              <th class="w-2 t-center bd-r-none">Hiển thị</th>
              <th class="w-1"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $key => $val)
                <tr>
                  <td class="bd-r-none">{{$key + 1}}</td>
                  <td class="bd-r-none">{{$val->product_name}}</td>
                  <td class="bd-r-none">{{$val->product_price}}</td>
                  <td class="bd-r-none"><img src="uploads/product/{{$val->product_image}}" width="100px" height="auto"></td>
                  <td class="bd-r-none">{{$val->category()->first()->category_name}}</td>
                  <td class="bd-r-none">{{$val->brand()->first()->brand_name}}</td>
                  <td class="t-center bd-r-none">
                    @if ($val->product_status == 1)
                      <span class="active m-r-20" ui-toggle-class="">
                        <i class="fas fa-thumbs-up text-success text-active"></i>
                      </span>
                    @else
                      <span class="active m-r-20" ui-toggle-class="">
                        <i class="fas fa-thumbs-down text-danger text"></i>
                      </span>
                    @endif
                  </td>
                  <td class="t-center">
                    <a href="{{route("viewEditProduct",$val->product_id)}}" class="active m-r-20" ui-toggle-class="">
                      <i class="fas fa-edit text-success text-active"></i>
                    </a>
                    <a href="{{route("handleDelProduct",$val->product_id)}}" class="active" ui-toggle-class="" onclick="return del_category_product('{{$val['product_name']}}')">
                        <i class="fa fa-times text-danger text"></i>
                    </a>
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @push('script')
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>  
    <script type="text/javascript">
      function del_category_product(product_name){
        return confirm("Bạn muốn xóa sản phẩm "+ product_name);
      }
    </script>
  @endpush
@endsection