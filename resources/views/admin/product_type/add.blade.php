@extends('admin.main')

@section('content')
<form action="" method="post">
  <div class="card-body">

    <div class="form-group">
      <label for="name">Tên loại sản phẩm</label>
      <input type="text" class="form-control" name="name" placeholder="Nhập tên loại sản phẩm">
    </div>
    <div class="form-group">
      <label>Ảnh sản phẩm</label>
      <input type="file" class="form-control" id="upload">
      <div id="image_show" class="mt-3"></div>
      <input type="hidden" name="thumb" id="thumb">
    </div>
    <div class="form-group">
      <label>Kích hoạt</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
        <label for="active" class="custom-control-label">Có</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" value="0" type="radio" id="no_active" name="active">
        <label for="no_active" class="custom-control-label">Không</label>
      </div>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-success">Tạo loại sản phẩm</button>
    <a href="/admin/product_types/list" class="btn btn-secondary">Quay lại</a>
  </div>
  @csrf
</form>
@endsection
