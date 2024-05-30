@extends('customer.layout.main')
@section('main')
<section class="main-order">
  <div class="container">
    <h2 class="mb-3">Đơn hàng</h2>
    @include('customer.alert')
    @php
    $st1 = 0;
    $st2 = 0;
    $st3 = 0;
    $st4 = 0;
    $st5 = 0;
    @endphp

    @foreach ($orders as $order)
    @switch($order->status_id)
    @case(1)
    @php $st1++ @endphp
    @break
    @case(2)
    @php $st2++ @endphp
    @break
    @case(3)
    @php $st3++ @endphp
    @break
    @case(4)
    @php $st4++ @endphp
    @break
    @case(5)
    @php $st5++ @endphp
    @break
    @endswitch
    @endforeach
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="wait-tab" data-bs-toggle="tab" data-bs-target="#wait-tab-pane" type="button" role="tab" aria-controls="wait-tab-pane" aria-selected="true">Chờ xác nhận ({{ $st1 }})</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="confirm-tab" data-bs-toggle="tab" data-bs-target="#confirm-tab-pane" type="button" role="tab" aria-controls="confirm-tab-pane" aria-selected="false">Duyệt đơn hàng ({{ $st2 }})</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping-tab-pane" type="button" role="tab" aria-controls="shipping-tab-pane" aria-selected="false">Đang giao hàng ({{ $st3 }})</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="delivered-tab" data-bs-toggle="tab" data-bs-target="#delivered-tab-pane" type="button" role="tab" aria-controls="delivered-tab-pane" aria-selected="false">Đã giao hàng ({{ $st4 }})</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="cancel-tab" data-bs-toggle="tab" data-bs-target="#cancel-tab-pane" type="button" role="tab" aria-controls="cancel-tab-pane" aria-selected="false">Hủy đơn hàng ({{ $st5 }})</button>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="wait-tab-pane" role="tabpanel" aria-labelledby="wait-tab" tabindex="0">
        @foreach ($orders as $order)
        @if ($order->status_id == 1)
        <div class="order">
          <div class="order-detail">
            @if ($order->user_id)
            <p>Người giao hàng: {{ $order->user->name }} ({{ $order->user->phone }})</p>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h6><b>Đơn hàng {{ $order->id }} </b>({{ date('d/m/Y H:i:s', strtotime($order->updated_at)) }})</h6>
              <div class="main-order-@switch($order->status_id)
          @case(1)wait
          @break
          @case(2)confirm
          @break
          @case(3)shipping
          @break
          @case(4)delivered
          @break
          @case(5)cancel
          @break
          @default null 
          @endswitch">
                {{ $order->status->name }}
              </div>
            </div>
            <ul class="order-head d-flex">
              <li>Sản phẩm</li>
              <li>Đơn giá</li>
              <li>Số lượng</li>
              <li>Thành tiền</li>
            </ul>
            @foreach ($order->orderdetails as $detail)
            <ul class="order-main d-flex">
              <li class="order-main-img d-flex align-items-center flex-lg-row flex-column">
                <img src="{{ $detail->product->thumb }}" alt="{{ $detail->product->name }}" width="120px" class="img-fluid">
                <p class="ms-4">
                  {{ $detail->product->name }}
                </p>
              </li>
              <li class="d-flex flex-column align-items-center justify-content-center">
                @if($detail->product->promotion_id != 1)
                <p class="mb-0"><del>{{ number_format($detail->product->price, 0, '.', '.') }}₫</del></p>
                @endif
                <p class="mb-0">{{ number_format($detail->price_sale, 0, '.', '.') }}₫</p>
              </li>
              <li class="d-flex align-items-center justify-content-center">
                <p class="mb-0">x{{ $detail->quantity }}</p>
              </li>
              <li class="d-flex align-items-center justify-content-center">
                <p class="mb-0">{{ number_format($detail->price, 0, '.', '.') }}₫</p>
              </li>
            </ul>
            @endforeach
            @php
            $total = $order->orderDetails->sum(function ($detail) {
            return $detail->price * $detail->quantity;
            });
            @endphp
            <ul class="d-flex mb-0">
              <li></li>
              <li></li>
              <li class="text-end"><b>Tổng tiền:</b></li>
              <li class="text-center"><b>{{ number_format($total, 0, '.', '.') }} ₫</b></li>
            </ul>
            @if($order->sale_id)
            <ul class="d-flex mb-0 text-danger">
              <li></li>
              <li></li>
              <li class="text-end"><b>Mã giảm giá:</b></li>
              <li class="text-center"><b>{{ $order->sale->name }}</b></li>
            </ul>
            <ul class="d-flex mb-0 text-danger">
              <li></li>
              <li></li>
              <li class="text-end"><b>Tổng tiền giảm:</b></li>
              <li class="text-center"><b>{{ number_format($total*(1-$order->sale->sale), 0, '.', '.') }} ₫</b></li>
            </ul>
            @endif
          </div>
        </div>
        @endif
        @endforeach
      </div>
      <div class="tab-pane fade" id="confirm-tab-pane" role="tabpanel" aria-labelledby="confirm-tab" tabindex="0">
        @foreach ($orders as $order)
        @if ($order->status_id == 2)
        <div class="order">
          <div class="order-detail">
            @if ($order->user_id)
            <p>Người giao hàng: {{ $order->user->name }} ({{ $order->user->phone }})</p>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h6><b>Đơn hàng {{ $order->id }} </b>({{ date('d/m/Y H:i:s', strtotime($order->updated_at)) }})</h6>
              <div class="main-order-@switch($order->status_id)
          @case(1)wait
          @break
          @case(2)confirm
          @break
          @case(3)shipping
          @break
          @case(4)delivered
          @break
          @case(5)cancel
          @break
          @default null 
          @endswitch">
                {{ $order->status->name }}
              </div>
            </div>
            <ul class="order-head d-flex">
              <li>Sản phẩm</li>
              <li>Đơn giá</li>
              <li>Số lượng</li>
              <li>Thành tiền</li>
            </ul>
            @foreach ($order->orderdetails as $detail)
            <ul class="order-main d-flex">
              <li class="order-main-img d-flex align-items-center flex-lg-row flex-column">
                <img src="{{ $detail->product->thumb }}" alt="{{ $detail->product->name }}" width="120px" class="img-fluid">
                <p class="ms-4">
                  {{ $detail->product->name }}
                </p>
              </li>
              <li class="d-flex flex-column align-items-center justify-content-center">
                @if($detail->product->promotion_id != 1)
                <p class="mb-0"><del>{{ number_format($detail->product->price, 0, '.', '.') }}₫</del></p>
                @endif
                <p class="mb-0">{{ number_format($detail->price_sale, 0, '.', '.') }}₫</p>
              </li>
              <li class="d-flex align-items-center justify-content-center">
                <p class="mb-0">x{{ $detail->quantity }}</p>
              </li>
              <li class="d-flex align-items-center justify-content-center">
                <p class="mb-0">{{ number_format($detail->price, 0, '.', '.') }}₫</p>
              </li>
            </ul>
            @endforeach
            @php
            $total = $order->orderDetails->sum(function ($detail) {
            return $detail->price * $detail->quantity;
            });
            @endphp
            <ul class="d-flex mb-0">
              <li></li>
              <li></li>
              <li class="text-end"><b>Tổng tiền:</b></li>
              <li class="text-center"><b>{{ number_format($total, 0, '.', '.') }} ₫</b></li>
            </ul>
            @if($order->sale_id)
            <ul class="d-flex mb-0 text-danger">
              <li></li>
              <li></li>
              <li class="text-end"><b>Mã giảm giá:</b></li>
              <li class="text-center"><b>{{ $order->sale->name }}</b></li>
            </ul>
            <ul class="d-flex mb-0 text-danger">
              <li></li>
              <li></li>
              <li class="text-end"><b>Tổng tiền giảm:</b></li>
              <li class="text-center"><b>{{ number_format($total*(1-$order->sale->sale), 0, '.', '.') }} ₫</b></li>
            </ul>
            @endif
          </div>
        </div>
        @endif
        @endforeach
      </div>
      <div class="tab-pane fade" id="shipping-tab-pane" role="tabpanel" aria-labelledby="shipping-tab" tabindex="0">
        @foreach ($orders as $order)
        @if ($order->status_id == 3)
        <div class="order">
          <div class="order-detail">
            @if ($order->user_id)
            <p>Người giao hàng: {{ $order->user->name }} ({{ $order->user->phone }})</p>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h6><b>Đơn hàng {{ $order->id }} </b>({{ date('d/m/Y H:i:s', strtotime($order->updated_at)) }})</h6>
              <div class="main-order-@switch($order->status_id)
          @case(1)wait
          @break
          @case(2)confirm
          @break
          @case(3)shipping
          @break
          @case(4)delivered
          @break
          @case(5)cancel
          @break
          @default null 
          @endswitch">
                {{ $order->status->name }}
              </div>
            </div>
            <ul class="order-head d-flex">
              <li>Sản phẩm</li>
              <li>Đơn giá</li>
              <li>Số lượng</li>
              <li>Thành tiền</li>
            </ul>
            @foreach ($order->orderdetails as $detail)
            <ul class="order-main d-flex">
              <li class="order-main-img d-flex align-items-center flex-lg-row flex-column">
                <img src="{{ $detail->product->thumb }}" alt="{{ $detail->product->name }}" width="120px" class="img-fluid">
                <p class="ms-4">
                  {{ $detail->product->name }}
                </p>
              </li>
              <li class="d-flex flex-column align-items-center justify-content-center">
                @if($detail->product->promotion_id != 1)
                <p class="mb-0"><del>{{ number_format($detail->product->price, 0, '.', '.') }}₫</del></p>
                @endif
                <p class="mb-0">{{ number_format($detail->price_sale, 0, '.', '.') }}₫</p>
              </li>
              <li class="d-flex align-items-center justify-content-center">
                <p class="mb-0">x{{ $detail->quantity }}</p>
              </li>
              <li class="d-flex align-items-center justify-content-center">
                <p class="mb-0">{{ number_format($detail->price, 0, '.', '.') }}₫</p>
              </li>
            </ul>
            @endforeach
            @php
            $total = $order->orderDetails->sum(function ($detail) {
            return $detail->price * $detail->quantity;
            });
            @endphp
            <ul class="d-flex mb-0">
              <li></li>
              <li></li>
              <li class="text-end"><b>Tổng tiền:</b></li>
              <li class="text-center"><b>{{ number_format($total, 0, '.', '.') }} ₫</b></li>
            </ul>
            @if($order->sale_id)
            <ul class="d-flex mb-0 text-danger">
              <li></li>
              <li></li>
              <li class="text-end"><b>Mã giảm giá:</b></li>
              <li class="text-center"><b>{{ $order->sale->name }}</b></li>
            </ul>
            <ul class="d-flex mb-0 text-danger">
              <li></li>
              <li></li>
              <li class="text-end"><b>Tổng tiền giảm:</b></li>
              <li class="text-center"><b>{{ number_format($total*(1-$order->sale->sale), 0, '.', '.') }} ₫</b></li>
            </ul>
            @endif
          </div>
        </div>
        @endif
        @endforeach
      </div>
      <div class="tab-pane fade" id="delivered-tab-pane" role="tabpanel" aria-labelledby="delivered-tab" tabindex="0">
        @foreach ($orders as $order)
        @if ($order->status_id == 4)
        <div class="order">
          <div class="order-detail">
            @if ($order->user_id)
            <p>Người giao hàng: {{ $order->user->name }} ({{ $order->user->phone }})</p>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h6><b>Đơn hàng {{ $order->id }} </b>({{ date('d/m/Y H:i:s', strtotime($order->updated_at)) }})</h6>
              <div class="main-order-@switch($order->status_id)
          @case(1)wait
          @break
          @case(2)confirm
          @break
          @case(3)shipping
          @break
          @case(4)delivered
          @break
          @case(5)cancel
          @break
          @default null 
          @endswitch">
                {{ $order->status->name }}
              </div>
            </div>
            <ul class="order-head d-flex">
              <li>Sản phẩm</li>
              <li>Đơn giá</li>
              <li>Số lượng</li>
              <li>Thành tiền</li>
            </ul>
            @foreach ($order->orderdetails as $detail)
            <ul class="order-main d-flex">
              <li class="order-main-img d-flex align-items-center flex-lg-row flex-column">
                <img src="{{ $detail->product->thumb }}" alt="{{ $detail->product->name }}" width="120px" class="img-fluid">
                <p class="ms-4">
                  {{ $detail->product->name }}
                </p>
              </li>
              <li class="d-flex flex-column align-items-center justify-content-center">
                @if($detail->product->promotion_id != 1)
                <p class="mb-0"><del>{{ number_format($detail->product->price, 0, '.', '.') }}₫</del></p>
                @endif
                <p class="mb-0">{{ number_format($detail->price_sale, 0, '.', '.') }}₫</p>
              </li>
              <li class="d-flex align-items-center justify-content-center">
                <p class="mb-0">x{{ $detail->quantity }}</p>
              </li>
              <li class="d-flex align-items-center justify-content-center">
                <p class="mb-0">{{ number_format($detail->price, 0, '.', '.') }}₫</p>
              </li>
            </ul>
            @endforeach
            @php
            $total = $order->orderDetails->sum(function ($detail) {
            return $detail->price * $detail->quantity;
            });
            @endphp
            <ul class="d-flex mb-0">
              <li></li>
              <li></li>
              <li class="text-end"><b>Tổng tiền:</b></li>
              <li class="text-center"><b>{{ number_format($total, 0, '.', '.') }} ₫</b></li>
            </ul>
            @if($order->sale_id)
            <ul class="d-flex mb-0 text-danger">
              <li></li>
              <li></li>
              <li class="text-end"><b>Mã giảm giá:</b></li>
              <li class="text-center"><b>{{ $order->sale->name }}</b></li>
            </ul>
            <ul class="d-flex mb-0 text-danger">
              <li></li>
              <li></li>
              <li class="text-end"><b>Tổng tiền giảm:</b></li>
              <li class="text-center"><b>{{ number_format($total*(1-$order->sale->sale), 0, '.', '.') }} ₫</b></li>
            </ul>
            @endif
          </div>
        </div>
        @endif
        @endforeach
      </div>
      <div class="tab-pane fade" id="cancel-tab-pane" role="tabpanel" aria-labelledby="cancel-tab" tabindex="0">
        @foreach ($orders as $order)
        @if ($order->status_id == 5)
        <div class="order">
          <div class="order-detail">
            @if ($order->user_id)
            <p>Người giao hàng: {{ $order->user->name }} ({{ $order->user->phone }})</p>
            @endif
            <div class="d-flex justify-content-between align-items-center mb-4">
              <h6><b>Đơn hàng {{ $order->id }} </b>({{ date('d/m/Y H:i:s', strtotime($order->updated_at)) }})</h6>
              <div class="main-order-@switch($order->status_id)
          @case(1)wait
          @break
          @case(2)confirm
          @break
          @case(3)shipping
          @break
          @case(4)delivered
          @break
          @case(5)cancel
          @break
          @default null 
          @endswitch">
                {{ $order->status->name }}
              </div>
            </div>
            <ul class="order-head d-flex">
              <li>Sản phẩm</li>
              <li>Đơn giá</li>
              <li>Số lượng</li>
              <li>Thành tiền</li>
            </ul>
            @foreach ($order->orderdetails as $detail)
            <ul class="order-main d-flex">
              <li class="order-main-img d-flex align-items-center flex-lg-row flex-column">
                <img src="{{ $detail->product->thumb }}" alt="{{ $detail->product->name }}" width="120px" class="img-fluid">
                <p class="ms-4">
                  {{ $detail->product->name }}
                </p>
              </li>
              <li class="d-flex flex-column align-items-center justify-content-center">
                @if($detail->product->promotion_id != 1)
                <p class="mb-0"><del>{{ number_format($detail->product->price, 0, '.', '.') }}₫</del></p>
                @endif
                <p class="mb-0">{{ number_format($detail->price_sale, 0, '.', '.') }}₫</p>
              </li>
              <li class="d-flex align-items-center justify-content-center">
                <p class="mb-0">x{{ $detail->quantity }}</p>
              </li>
              <li class="d-flex align-items-center justify-content-center">
                <p class="mb-0">{{ number_format($detail->price, 0, '.', '.') }}₫</p>
              </li>
            </ul>
            @endforeach
            @php
            $total = $order->orderDetails->sum(function ($detail) {
            return $detail->price * $detail->quantity;
            });
            @endphp
            <ul class="d-flex mb-0">
              <li></li>
              <li></li>
              <li class="text-end"><b>Tổng tiền:</b></li>
              <li class="text-center"><b>{{ number_format($total, 0, '.', '.') }} ₫</b></li>
            </ul>
            @if($order->sale_id)
            <ul class="d-flex mb-0 text-danger">
              <li></li>
              <li></li>
              <li class="text-end"><b>Mã giảm giá:</b></li>
              <li class="text-center"><b>{{ $order->sale->name }}</b></li>
            </ul>
            <ul class="d-flex mb-0 text-danger">
              <li></li>
              <li></li>
              <li class="text-end"><b>Tổng tiền giảm:</b></li>
              <li class="text-center"><b>{{ number_format($total*(1-$order->sale->sale), 0, '.', '.') }} ₫</b></li>
            </ul>
            @endif
          </div>
        </div>
        @endif
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection
