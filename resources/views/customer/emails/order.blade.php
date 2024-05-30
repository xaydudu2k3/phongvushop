<html>

<head>
    <style>
        .main {
            background: lightcyan;
            margin: 0 auto;
            padding: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="main">
        <h2 style="text-align: center">Chào {{ $customer->name }}</h2>
        <p>Đơn hàng của bạn {{ $content }}</p>
        <p style="margin-bottom: 10px"><b>Địa chỉ nhận hàng</b></p>
        <p style="margin-bottom: 0">Họ và tên: {{ $order->customer->name }}</p>
        <p style="margin-bottom: 0">Số điện thoại: {{ $order->customer->phone }}</p>
        <p style="margin-bottom: 50px">Địa chỉ: {{ $order->customer->address }}</p>
        @if ($order->user_id)
            <p style="margin-bottom: 50px"><b>Người giao hàng: {{ $order->user->name }} ({{ $order->user->phone }})</b>
            </p>
        @endif
        <p><b>Đơn hàng {{ $order->id }}</b></p>
        <table style="width: 100%;">
            <tr>
                <th style="width: 5%">STT</th>
                {{-- <th>Ảnh</th> --}}
                <th style="width: 50%">Sản phẩm</th>
                <th style="width: 15%">Số lượng</th>
                <th style="width: 30%">Thành tiền</th>
            </tr>
            @php $i = 1 @endphp
            @foreach ($order->orderdetails as $detail)
                <tr>
                    <td>{{ $i }}</td>
                    {{-- <td>
          <img src="{{ asset($detail->product->thumb) }}" alt="{{ $detail->product->name }}" width="90px">
        </td> --}}
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
            @php
                $total = $order->orderDetails->sum(function ($detail) {
                    return $detail->price * $detail->quantity;
                });
            @endphp
            <tr>
                <th colspan="3" style="text-align: end">Tổng tiền:</th>
                <th>{{ number_format($total, 0, '.', '.') }}₫</th>
            </tr>
            @if ($order->sale_id != null)
                <tr style="color: tomato;">
                    <th colspan="3" style="text-align: end">Mã giảm giá:</th>
                    <th>{{ $order->sale->name }}</th>
                </tr>
                <tr style="color: tomato;">
                    <th colspan="3" style="text-align: end">Tổng tiền giảm:</th>
                    <th>{{ number_format($total * (1 - $order->sale->sale), 0, '.', '.') }}₫</th>
                </tr>
            @endif
        </table>
    </div>
</body>

</html>
