@extends('admin.main')

@section('content')
<form action="" method="post">
  <div class="card-body">
    <div class="row">
      <div class="form-group col-md-6">
        <label for="name">Tên nhân viên</label>
        <input type="text" class="form-control" name="name" disabled value="{{ $user->name }}">
      </div>
      <div class="form-group col-md-6">
        <label for="usertype_id">Giới tính</label>
        <input type="text" class="form-control" disabled value="{{ ($user->gender == 1) ? 'Nam' : 'Nữ' }}">
      </div>
      <div class="form-group col-md-6">
        <label for="usertype_id">Loại nhân viên</label>
        <input type="text" class="form-control" disabled value="{{ $user->userType->name }}">
      </div>
      <div class="form-group col-md-6">
        <label for="name">CCCD</label>
        <input type="text" class="form-control" name="cccd" disabled value="{{ $user->cccd }}">
      </div>
      <div class="form-group col-md-6">
        <label for="phone">Số điện thoại</label>
        <input type="text" class="form-control" name="phone" disabled value="{{ $user->phone }}">
      </div>
      <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" disabled value="{{ $user->email }}">
      </div>
      <div class="form-group col-md-6">
        <label for="password">Mật khẩu</label>
        <input type="text" class="form-control" name="password" disabled value="{{ $user->password }}">
      </div>
    </div>
    <div class="form-group">
      <label>Ảnh nhân viên</label>
      <div id="image_show" class="mt-3">
        <a href="{{ $user->thumb }}" target="_blank">
          <img src="{{ $user->thumb }}" width="100px">
        </a>
      </div>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <a onclick="history.back(-1)" class="btn btn-secondary">Quay lại</a>
  </div>
  @csrf
</form>
@endsection
