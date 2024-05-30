@extends('admin.main')

@section('content')
<form action="" method="post">
  <div class="card-body">

    <div class="form-group">
      <label for="name">Tên khuyến mãi</label>
      <input type="text" class="form-control" name="name" placeholder="Nhập tên khuyến mãi">
    </div>
    <div class="form-group">
      <label for="name">Số khuyến mãi</label>
      <input type="text" class="form-control" name="sale" placeholder="Nhập số khuyễn mãi">
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-success">Tạo khuyến mãi</button>
    <a href="/admin/promotions/list" class="btn btn-secondary">Quay lại</a>
  </div>
  @csrf
</form>
@endsection
