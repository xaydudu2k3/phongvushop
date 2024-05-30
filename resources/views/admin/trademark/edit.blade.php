@extends('admin.main')

@section('content')
<form action="" method="post">
  <div class="card-body">
    <div class="row">
      <div class="form-group col-md-6">
        <label for="name">Tên thương hiệu</label>
        <input type="text" class="form-control" name="name" value="{{ $trademark->name }}" placeholder="Nhập tên thương hiệu">
      </div>
      <div class="form-group col-md-6">
        <label>Đường đẫn</label>
        <input type="text" class="form-control" name="url" placeholder="Nhập đường dẫn" value="{{ $trademark->url }}">
      </div>
    </div>
    <div class="form-group">
      <label>Ảnh sản phẩm</label>
      <input type="file" class="form-control" id="upload">
      <div id="image_show" class="mt-3">
        <a href="{{ $trademark->thumb }}" target="_blank">
          <img src="{{ $trademark->thumb }}" width="100px">
        </a>
      </div>
      <input type="hidden" value="{{ $trademark->thumb }}" name="thumb" id="thumb">
    </div>
  </div>

  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Cập Nhật thương hiệu</button>
    <a href="/admin/trademarks/list" class="btn btn-secondary">Quay lại</a>
  </div>
  @csrf
</form>

@endsection
