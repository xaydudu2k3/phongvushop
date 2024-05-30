@extends('admin.main')

@section('content')
<form action="" method="post">
  <div class="card-body">
    <div class="row">
      <div class="form-group col-md-6">
        <label for="name">Tên nhân viên</label>
        <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Nhập tên nhân viên">
      </div>
      <div class="form-group col-md-6">
        <label>Giới tính</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gender" id="gender_male" value="1" {{ ($user->gender == 1) ? 'checked' : '' }}>
          <label class="form-check-label" for="gender_male">
            Nam
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gender" id="gender_female" value="0" {{ ($user->gender == 0) ? 'checked' : '' }}>
          <label class="form-check-label" for="gender_female">
            Nữ
          </label>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label for="usertype_id">Loại nhân viên</label>
        <select name="usertype_id" class="form-control form-select">
          @foreach ($usertypes as $usertype)
          <option value="{{ $usertype->id }}" {{ $user->usertype_id == $usertype->id ? 'selected' : '' }}>{{ $usertype->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="name">CCCD</label>
        <input type="text" class="form-control" name="cccd" value="{{ $user->cccd }}" placeholder="Nhập CCCD nhân viên">
      </div>
      <div class="form-group col-md-6">
        <label for="phone">Số điện thoại</label>
        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Nhập sđt nhân viên">
      </div>
      <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input type="text" class="form-control" name="email" value="{{ $user->email }}" placeholder="Nhập email nhân viên">
      </div>
      <div class="form-group col-md-6">
        <label for="password">Mật khẩu</label>
        <input type="password" class="form-control" name="password" value="{{ $user->password }}" placeholder="Nhập mật khẩu nhân viên">
      </div>
    </div>
    <div class="form-group">
      <label>Ảnh nhân viên</label>
      <input type="file" class="form-control" id="upload">
      <div id="image_show" class="mt-3">
        <a href="{{ $user->thumb }}" target="_blank">
          <img src="{{ $user->thumb }}" width="100px">
        </a>
      </div>
      <input type="hidden" value="{{ $user->thumb }}" name="thumb" id="thumb">
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Cập Nhật nhân viên</button>
    <a href="/admin/users/list" class="btn btn-secondary">Quay lại</a>
  </div>
  @csrf
</form>

@endsection

