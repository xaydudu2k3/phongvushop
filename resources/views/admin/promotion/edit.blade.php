@extends('admin.main')

@section('content')
<form action="" method="post">
  <div class="card-body">

    <div class="form-group">
      <label for="name">Tên khuyến mãi</label>
      <input type="text" class="form-control" name="name" value="{{ $promotion->name }}" placeholder="Nhập tên khuyến mãi">
    </div>
    <div class="form-group">
      <label for="name">Số khuyến mãi</label>
      <input type="text" class="form-control" name="sale" value="{{ $promotion->sale }}"  placeholder="Nhập số khuyến mãi">
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Cập Nhật khuyến mãi</button>
    <a href="/admin/promotions/list" class="btn btn-secondary">Quay lại</a>
  </div>
  @csrf
</form>

@endsection

