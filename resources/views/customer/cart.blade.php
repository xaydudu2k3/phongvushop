@extends('customer.layout.main')
@section('main')
<section class="main-cart">
  <div class="container">
    <div>
      <h2 class="mb-3">{{ $title }}</h2>
      @include('customer.alert')
      @if (count($products) != 0)
      <form method="POST" action="checkSaleToken">
        @csrf
        <div class="left">
          <div class="text-end">
            <button type="submit" class="btn btn-outline-success" formaction="/update-cart" style="transition: 0.3s">
              Cập nhật
            </button>
            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" style="transition: 0.3s">
              Xóa tất cả
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thông báo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">Bạn có chắc muốn xóa toàn bộ sản phẩm trong giỏ hàng?</div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-danger btn-delete-all">Xóa</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <ul class="cart-head">
            <li>Sản phẩm</li>
            <li>Đơn giá</li>
            <li>Số lượng</li>
            <li>Thành tiền</li>
            <li></li>
          </ul>
          @php $total = 0; $qtt = 0; @endphp
          <ul class="cart-shop">
            @foreach ($products as $key => $product)
            @php
            $price = $product->price - $product->price * $product->promotion->sale;
            $priceSum = $price * $carts[$product->id];
            $qtt += $carts[$product->id];
            $total += $priceSum;
            @endphp
            <li class="d-flex align-items-center">
              <div class="p-2 cart-shop-product d-flex align-items-center flex-lg-row flex-column">
                <img class="img-fluid" src="{{ $product->thumb }}" alt="{{ $product->name }}" width="100px">
                <p class="mb-0 ms-2">{{ $product->name }}</p>
              </div>
              <div class="cart-shop-price p-2">
                @if($product->promotion->sale != 0)
                <small><del>{{ number_format($product->price, 0, '.', '.') }}đ</del></small>
                @endif
                <p class="mb-0">{{ number_format($price, 0, '.', '.') }}đ</p>
              </div>
              <div class="cart-shop-quantity d-flex">
                <button type="button" class="btn-quantity-minus d-none d-lg-flex align-items-center"><i class="fa-solid fa-minus"></i></button>
                <input type="number" name="num_product[{{ $product->id }}]" class="text-center cart-shop-quantity-input btn-quantity" value="{{ $carts[$product->id] }}" min="1" max="{{ $product->quantity }}">
                <button type="button" class="btn-quantity-plus d-none d-lg-flex align-items-center"><i class="fa-solid fa-plus"></i></button>
              </div>
              <div class="cart-shop-sum text-center">
                <p class="mb-0">{{ number_format($priceSum, 0, '.', '.') }}đ</p>
              </div>
              <div class="cart-shop-delete text-center">
                <button type="button" class="btn btn-outline-danger btn-delete delete-product border-0" data-id="{{ $product->id }}" style="transition: 0.3s">Xóa</button>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
        <div class="right">
          <div class="mb-3">
            <label class="form-label">Mã khuyến mãi</label>
            <input type="text" name="cart_token" class="form-control">
          </div>
          <h6 class="mb-3"><b>Thanh toán</b></h6>
          <div class="d-flex justify-content-between mb-3">
            <p>Tổng sản phẩm</p>
            <p class="main-cart-quantity">x{{ $qtt }}</p>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <p>Tổng tiền</p>
            <p class="main-cart-sum">{{ number_format($total, 0, '.', '.') }}đ</p>
          </div>
          <button type="submit" class="btn w-100 mb-4">Thanh toán</button>
        </div>
      </form>
      @else
      <div class="main-cart-empty">
        <h3 class="text-center pt-4">Chưa có sản phẩm nào</h3>
        <a class="mt-5" href="product">Mua sắm ngay</a>
      </div>
      @endif
    </div>
  </div>
</section>
@endsection
