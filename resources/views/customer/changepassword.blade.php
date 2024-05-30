@extends('layout.main')
@section('main')

<section class="main-login">
  <div class="container">
    <h2 class="mb-3 text-center">Đặt lại mật khẩu</h2>
    <form action="" method="POST" class="mx-auto">
      @csrf
      @include('alert')
      <div class="input-box">
        <input type="password" name="password" required='required' autocomplete="off">
        <span>Mật khẩu</span>
        <div class="show-password" style="position: absolute; cursor: pointer; ; right: 14px; bottom: 10px;">
          <i class="fa-regular fa-eye-slash"></i>
        </div>
      </div>
      <div class="input-box">
        <input type="password" name="confirm_password" required='required' autocomplete="off">
        <span>Nhập lại mật khẩu</span>
        <div class="show-password" style="position: absolute; cursor: pointer; ; right: 14px; bottom: 10px;">
          <i class="fa-regular fa-eye-slash"></i>
        </div>
      </div>
      <button type="submit" class="btn-submit">Xác nhận</button>
    </form>
  </div>
</section>

@endsection