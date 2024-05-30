@extends('customer.layout.main')
@section('main')

<section class="main-login">
  <div class="container">
    <h2 class="mb-3 text-center">Kích hoạt tài khoản</h2>
    <form action="" method="POST" class="mx-auto">
      @csrf
      @include('customer.alert')
      <p>(Vui lòng nhập email mà bạn đã đăng ký)</p>
      <div class="input-box">
        <input type="text" name="email" required='required'>
        <span>Email</span>
      </div>
      <button type="submit" class="btn-submit">Gửi email xác nhận</button>
      <div class="my-2">Bạn đã có tài khoản ? <a href="/login">Đăng nhập</a></div>
    </form>
  </div>
</section>

@endsection
