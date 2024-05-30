@extends('admin.main')

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-start">
        <div>
            <p class="mb-1"><b>Thông tin khách hàng</b></p>
            <p class="mb-0">Họ và tên: {{ $order->customer->name }}</p>
            <p class="mb-0">Số điện thoại: {{ $order->customer->phone }}</p>
            <p class="mb-0">Địa chỉ: {{ $order->customer->address }}</p>
        </div>
        <div
            class="print-hidden mb-3 main-order-@switch($order->status_id)
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
    <p class="mb-2"><b>Đơn hàng đã đặt</b></p>
    <table class="table table-hover table-bordered table-info">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Ảnh</th>
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
                        <img src="{{ $detail->product->thumb }}" alt="{{ $detail->product->name }}" width="90px">
                    </td>
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
                <th colspan="4" class="text-end">Tổng tiền:</th>
                <th>{{ number_format($total, 0, '.', '.') }}₫</th>
            </tr>
            @if ($order->sale_id != null)
                <tr class="text-danger">
                    <th colspan="4" class="text-end">Mã giảm giá:</th>
                    <th>{{ $order->sale->name }}</th>
                </tr>
                <tr class="text-danger">
                    <th colspan="4" class="text-end">Tổng tiền giảm:</th>
                    <th>{{ number_format($total * (1 - $order->sale->sale), 0, '.', '.') }}₫</th>
                </tr>
            @endif
        </tfoot>
    </table>
    <form action="" method="post">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Trạng thái</label>
                    <select name="status_id" class="form-control form-select"
                        {{ $order->status_id == 5 || ($order->updated_at->diffInDays(now()) > 3 && $order->status_id == 4) ? 'disabled' : '' }}>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" {{ $order->status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Người giao hàng</label>
                    <select name="user_id" class="form-control form-select" id="user-select"
                        {{ $order->status_id == 5 || ($order->updated_at->diffInDays(now()) > 3 && $order->status_id == 4) ? 'disabled' : '' }}>
                        <option value="">Chọn người giao</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary print-hidden">Cập Nhật đơn hàng</button>
            <a href="/admin/orders/list" class="btn btn-secondary print-hidden">Quay lại</a>
        </div>
        @csrf
    </form>
@endsection
