@extends('customer.layout.main')
@section('main')
    <section class="main-pay">
        <div class="container">
            <div>
                @if (count($products) != 0)
                    <h2 class="mb-3">Thanh toán đơn hàng</h2>
                    <form method="post" action="/addpay" id="form-pay">
                        @csrf
                        <div class="left">
                            <div class="makecolor"></div>
                            <div class="pay-customer">
                                <h6 class="mb-3"><i class="fa-solid fa-location-dot"></i> Địa chỉ nhận hàng</h6>
                                <p class="mb-1"><b>Họ và tên:</b> {{ Auth::guard('cus')->user()->name }}</p>
                                <p class="mb-1"><b>Số điện thoại:</b> {{ Auth::guard('cus')->user()->phone }}</p>
                                <p class="mb-1"><b>Địa chỉ:</b> {{ Auth::guard('cus')->user()->address }}</p>
                                <div class="d-flex pay-customer-change align-items-center mt-3">
                                    <p class="m-0"><small>Mặc định</small></p>
                                    <a href="/info" class="ms-4"><small>Thay đổi</small></a>
                                </div>
                                <input type="hidden" name="customer_id" value="{{ Auth::guard('cus')->user()->id }}">
                            </div>
                            <div class="pay-hr"></div>
                            <div class="pay-product">
                                <table class="w-100">
                                    <thead class="text-center">
                                        <tr>
                                            <th style="width: 50%;">Sản phẩm</th>
                                            <th style="width: 20%;">Đơn giá</th>
                                            <th style="width: 10%;">Số lượng</th>
                                            <th style="width: 20%;">Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                            $qtt = 0;
                                        @endphp
                                        @foreach ($products as $key => $product)
                                            @php
                                                $price = $product->price - $product->price * $product->promotion->sale;
                                                $priceSum = $price * $carts[$product->id];
                                                $qtt += $carts[$product->id];
                                                $total += $priceSum;
                                            @endphp
                                            <tr>
                                                <td colspan="4">
                                                    <div class="my-4 pay-hr"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center flex-lg-row flex-column">
                                                        <img src="{{ $product->thumb }}" alt="{{ $product->name }}"
                                                            class="img-fluid">
                                                        <p class="ms-3">{{ $product->name }}</p>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    @if ($product->promotion->sale != 0)
                                                        <p class="mb-1">
                                                            <small><del>{{ number_format($product->price, 0, '.', '.') }}đ</del></small>
                                                        </p>
                                                    @endif
                                                    <p class="mb-0">{{ number_format($price, 0, '.', '.') }}đ</p>
                                                </td>
                                                <td class="text-center">
                                                    x{{ $carts[$product->id] }}
                                                </td>
                                                <td class="text-center">{{ number_format($priceSum, 0, '.', '.') }}đ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="right">
                            <h6 class="mb-3"><b>Thanh toán hóa đơn</b></h6>
                            <div class="d-flex justify-content-between mb-3">
                                <p>Tổng sản phẩm</p>
                                <p class="main-pay-quantity">x{{ $qtt }}</p>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <p>Tổng tiền sản phẩm</p>
                                <p class="main-pay-sum">{{ number_format($total, 0, '.', '.') }}đ</p>
                            </div>
                            @if ($sale)
                                <div class="d-flex justify-content-between mb-3 text-danger">
                                    <p>Mã khuyến mãi</p>
                                    <p>{{ $sale->name }}</p>
                                </div>
                                <div class="d-flex justify-content-between mb-3 text-danger">
                                    <p>Tổng tiền đặt hàng</p>
                                    <p class="main-pay-sum">{{ number_format($total * (1 - $sale->sale), 0, '.', '.') }}đ</p>
                                </div>
                            @endif
                            <div class="w-100 text-center">
                                <button type="submit" class="truck-button mb-4">
                                    <span class="default">Đặt hàng</span>
                                    <span class="success">
                                        Đặt thành công
                                        <svg viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </svg>
                                    </span>
                                    <div class="truck">
                                        <div class="wheel"></div>
                                        <div class="back"></div>
                                        <div class="front"></div>
                                        <div class="box"></div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <h2 class="mb-5">Chưa có sản phẩm nào để thanh toán</h2>
                @endif
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('.main-pay form').on('submit', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var button = $('.truck-button');
            handleButtonClick(button)
                .then(function() {
                    // Hoàn thành animation
                    $('.main-pay form').submit(); // Submit form
                })
                .catch(function(error) {
                    console.error(error);
                });
        });

        function handleButtonClick(button) {

            let box = button.find('.box'),
                truck = button.find('.truck');

            if (!button.hasClass('done')) {

                if (!button.hasClass('animation')) {

                    button.addClass('animation');

                    gsap.to(button, {
                        '--box-s': 1,
                        '--box-o': 1,
                        duration: .3,
                        delay: .5
                    });

                    gsap.to(box, {
                        x: 0,
                        duration: .4,
                        delay: .7
                    });

                    gsap.to(button, {
                        '--hx': -5,
                        '--bx': 50,
                        duration: .18,
                        delay: .92
                    });

                    gsap.to(box, {
                        y: 0,
                        duration: .1,
                        delay: 1.15
                    });

                    gsap.set(button, {
                        '--truck-y': 0,
                        '--truck-y-n': -26
                    });

                    gsap.to(button, {
                        '--truck-y': 1,
                        '--truck-y-n': -25,
                        duration: .2,
                        delay: 1.25,
                        onComplete() {
                            gsap.timeline({
                                onComplete() {
                                    button.addClass('done');
                                    $('.main-pay form').submit();
                                }
                            }).to(truck, {
                                x: 0,
                                duration: .4
                            }).to(truck, {
                                x: 40,
                                duration: 1
                            }).to(truck, {
                                x: 20,
                                duration: .6
                            }).to(truck, {
                                x: 96,
                                duration: .4
                            });
                            gsap.to(button, {
                                '--progress': 1,
                                duration: 2.4,
                                ease: "power2.in"
                            });
                        }
                    });

                }

            } else {
                button.removeClass('animation done');
                gsap.set(truck, {
                    x: 4
                });
                gsap.set(button, {
                    '--progress': 0,
                    '--hx': 0,
                    '--bx': 0,
                    '--box-s': .5,
                    '--box-o': 0,
                    '--truck-y': 0,
                    '--truck-y-n': -26
                });
                gsap.set(box, {
                    x: -24,
                    y: -6
                });
            }
        }
    </script>
@endsection
