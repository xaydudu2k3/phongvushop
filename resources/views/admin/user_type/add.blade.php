@extends('admin.main')

@section('content')
<form action="" method="post">
  <div class="card-body">

    <div class="form-group">
      <label for="name">Tên nhân viên</label>
      <input type="text" class="form-control" name="name" placeholder="Nhập tên loại nhân viên">
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-success">Tạo loại nhân viên</button>
    <a href="/admin/user_types/list" class="btn btn-secondary">Quay lại</a>
  </div>
  @csrf
</form>
@endsection

