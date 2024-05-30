@extends('customer.layout.main')
@section('main')
    <section class="main-detail">
        <div class="container">
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="main-detail-head">
                <div class="left">
                    <div class="main-detail-head-img">
                        <img class="img-fluid" src="{{ $product->thumb }}" alt="{{ $product->name }}" width="100%">
                    </div>
                    <div class="main-detail-head-name">
                        <h4>{{ $product->name }}</h4>
                        <p class="mb-2">Loại: {{ $product->producttype->name }}</p>
                        <p class="mb-2">Thương hiệu: <a href="{{ $product->trademark->url }}"
                                style="color: #62cdff;"><b>{{ $product->trademark->name }}</b></a></p>
                        <p class="mb-2">Số lượng: {{ $product->quantity }} <b
                                class="text-danger {{ $product->quantity == 0 ? '' : 'd-none' }}">( Sản phẩm đã hết hàng
                                )</b></p>
                        <div class="price mt-4">
                            @if ($product->promotion->sale != 0)
                                <h6><del>{{ number_format($product->price, 0, '.', '.') }}₫</del>
                                    <small>{{ $product->promotion->name }}</small> </h6>
                            @endif
                            <h5>{{ number_format($product->price - $product->price * $product->promotion->sale, 0, '.', '.') }}₫
                            </h5>
                        </div>
                        <div class="mt-4 mb-3">
                            <form method="POST" action="/addcart" class="add-to-cart-form">
                                <div class="col-4 mb-3 d-flex">
                                    <button type="button" class="btn-add w-25 btn-qtt-minus"><i
                                            class="fa-solid fa-minus"></i></button>
                                    <input class="input-quantity text-center" type="number" name="num_product"
                                        value="0" min="1" max="{{ $product->quantity }}"
                                        style="
              border: 1px solid gray;">
                                    <button type="button" class="btn-add w-25 btn-qtt-plus"><i
                                            class="fa-solid fa-plus"></i></button>
                                </div>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-buy w-100 add-to-cart-button"
                                        {{ $product->quantity == 0 ? 'disabled' : '' }}>THÊM VÀO GIỎ HÀNG</button>
                                </div>
                                @csrf
                            </form>
                        </div>
                    </div>
                    <hr class="w-100 px-3">
                    <div class="main-detail-head-configuration">
                        {!! str_replace('-', '<br> - ', $product->description) !!}
                    </div>
                    <div class="main-detail-head-promotion">
                        <div class="mb-3"><b>Khuyến mãi liên quan</b></div>
                        <ul>
                            <li class="mb-3">Hỗ trợ trả góp với đơn hàng từ 3.000.000đ. <a href="#">Xem chi tiết</a>
                            </li>
                            <li class="mb-3">Nhập mã VNPAYPV
                                <ul class="ps-2">
                                    <li>Tặng ngay <span class="text-danger">100.000đ</span> cho mỗi giao dịch thành công từ
                                        4,000,000đ
                                    </li>
                                    <li>Tặng ngay <span class="text-danger">200.000đ</span> cho mỗi giao dịch thành công từ
                                        15,000,000đ
                                    </li>
                                    <li>Tặng ngay <span class="text-danger">300.000đ</span> cho mỗi giao dịch thành công từ
                                        25,000,000đ
                                        khi thanh toán qua VNPAY-QR <a href="#">Xem chi tiết</a></li>
                                </ul>
                            </li>
                            <li>Nhận voucher giảm 600.000đ cho đơn từ 1.200.000đ khi hoàn thành mở thẻ TPBank EVO. <a
                                    href="#">Xem
                                    chi tiết</a></li>
                        </ul>
                    </div>
                </div>
                <div class="right">
                    <div class="main-detail-head-company d-flex align-items-center">
                        <div class="company-img">
                            <img src="/template/img/unnamed.png" class="img-fluid" alt="">
                        </div>
                        <h6 class="ms-4 mb-0">CÔNG TY CỔ PHẦN THƯƠNG MẠI DỊCH VỤ PHONG VŨ</h6>
                    </div>
                    <div class="main-detail-head-policy">
                        <div class="mb-3"><b>Chính sách bán hàng</b></div>
                        <ul class="ps-0">
                            <li class="d-flex"><img src="/template/img/ship.webp" alt=""><span class="ms-3">Miễn
                                    phí giao hàng cho đơn hàng
                                    từ 5 triệu</span></li>
                            <li class="d-flex"><img src="/template/img/shield.webp" alt=""><span class="ms-3">Cam
                                    kết hàng chính hãng 100%
                                </span></li>
                            <li class="d-flex"><img src="/template/img/trans.webp" alt=""><span class="ms-3">Đổi
                                    trả trong vòng 10 ngày
                                </span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main-detail-description ">
                <h4>Mô tả sản phẩm</h4>
                <div>
                    {!! $product->content !!}
                </div>
            </div>
            <div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addToCartModalLabel">Thông báo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                onclick="location.reload();"></button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="/template/img/tich.jpg" alt="tich" width="30%">
                            <p>Sản phẩm đã được thêm vào giỏ hàng!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                onclick="location.reload();">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
