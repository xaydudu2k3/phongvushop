@extends('admin.main')

@section('content')
@php
$ordernum = 0;
@endphp
@foreach ($orders as $order)
@if ($order->status_id == 4)
@php
$ordernum++;
@endphp
@endif
@endforeach
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-info-tab" data-bs-toggle="tab" data-bs-target="#nav-info" type="button" role="tab" aria-controls="nav-info" aria-selected="true">Thông tin khách hàng</button>
    <button class="nav-link" id="nav-order-tab" data-bs-toggle="tab" data-bs-target="#nav-order" type="button" role="tab" aria-controls="nav-order" aria-selected="false">Đơn hàng đã đặt thành công ({{ $ordernum }})</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab" tabindex="0">
    <form action="" method="post">
      <div class="card-body">
        <div class="row">
          <div class="form-group col-12">
            <label for="name">Tên khách hàng</label>
            <input type="text" class="form-control" name="name" value="{{ $customer->name }}" placeholder="Nhập tên khách hàng">
          </div>
          <div class="form-group col-md-6">
            <label for="name">Số điện thoại</label>
            <input type="text" class="form-control" name="phone" value="{{ $customer->phone }}" placeholder="Nhập số điện thoại khách hàng">
          </div>
          <div class="form-group col-md-6">
            <label for="name">Địa chỉ</label>
            <input type="text" class="form-control" name="address" value="{{ $customer->address }}" placeholder="Nhập địa chỉ khách hàng">
          </div>
          {{-- <div class="form-group col-md-6">
            <label>Tỉnh thành</label>
            <select class="form-control form-select" id="province-select">
              <option value="">Tỉnh</option>
              @foreach ($provinces as $province)
              <option value="{{ $province->id }}" {{ $customer->city->province_id == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-6">
            <label>Thành phố ( Quận, Huyện )</label>
            <select name="city_id" class="form-control form-select" id="city-select">
              <option value="">Thành phố</option>
              @foreach ($cities as $city)
              <option value="{{ $city->id }}" {{ $customer->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
              @endforeach
            </select>
          </div> --}}
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" value="{{ $customer->email }}" placeholder="Nhập email khách hàng">
          </div>
          <div class="form-group col-md-6">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" name="password" value="{{ $customer->password }}" placeholder="Nhập mật khẩu khách hàng">
          </div>
          <div class="form-group col-12 d-flex align-items-center">
            <label for="password" class="mb-0">Hiển thị thêm</label>
            <input class="ms-3" type="checkbox" id="checkCus">
          </div>
          <div class="form-group col-md-6" id="status">
            <label>Kích hoạt</label>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" value="1" type="radio" id="active" name="status" {{ $customer->status == 1 ? 'checked' : '' }}>
              <label for="active" class="custom-control-label">Có</label>
            </div>
            <div class="custom-control custom-radio">
              <input class="custom-control-input" value="0" type="radio" id="no_active" name="status" {{ $customer->status == 0 ? 'checked' : '' }}>
              <label for="no_active" class="custom-control-label">Không</label>
            </div>
          </div>

          <div class="form-group col-md-6" id="token">
            <label>Token</label>
            <input type="text" class="form-control" name="token" value="{{ $customer->token }}">
          </div>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Cập Nhật khách hàng</button>
        <a href="/admin/customers/list" class="btn btn-secondary">Quay lại</a>
      </div>
      @csrf
    </form>
  </div>
  <div class="tab-pane fade" id="nav-order" role="tabpanel" aria-labelledby="nav-order-tab" tabindex="0">
    @foreach ($orders as $order)
    @if ($order->status_id == 4)
    <p class="mb-2"><b>Đơn hàng {{ $order->id }} ({{ date('d/m/Y H:i:s', strtotime($order->updated_at)) }})</b></p>
    <table class="table table-hover table-bordered table-info">
      <thead>
        <tr>
          <th scope="col">STT</th>
          <th scope="col">Tên sản phẩm</th>
          <th scope="col">Số lượng</th>
          <th scope="col">Giá tiền</th>
        </tr>
      </thead>
      <tbody>
        @php $i = 1 @endphp
        @foreach ($order->orderdetails as $detail)
        <tr>
          <td>{{ $i }}</td>
          <td>
            {{ $detail->product->name }}
          </td>
          <td>
            {{ $detail->quantity }}
          </td>
          <td>
            {{ number_format($detail->price, 0, '.', '.') }}₫
          </td>
        </tr>
        @php $i++ @endphp
        @endforeach
      </tbody>
      @php
      $total = $order->orderDetails->sum(function ($detail) {
      return $detail->price * $detail->quantity;
      });
      @endphp
      <tfoot>
        <tr>
          <th colspan="3" class="text-end">Tổng tiền:</th>
          <th>{{ number_format($total, 0, '.', '.') }}₫</th>
        </tr>
        @if($order->sale_id != Null)
        <tr class="text-danger">
          <th colspan="3" class="text-end">Mã giảm giá:</th>
          <th>{{ $order->sale->name }}</th>
        </tr>
        <tr class="text-danger">
          <th colspan="3" class="text-end">Tổng tiền giảm:</th>
          <th>{{ number_format($total*(1 - $order->sale->sale), 0, '.', '.') }}₫</th>
        </tr>
        @endif
      </tfoot>
    </table>
    @endif
    @endforeach
  </div>
</div>

@endsection
