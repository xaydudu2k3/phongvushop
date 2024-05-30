@extends('admin.main')

@section('content')
<div class="row d-flex justify-content-md-between mb-3">
  <form method="GET" action="/admin/orders/list" class="input-group rounded col-md-8 w-auto align-items-center">
    <div class="form-outline">
      <select name="search" class="form-select rounded">
        <option value="">Chọn trạng thái</option>
        @foreach ($statuses as $status)
          <option value="{{ $status->id }}">
            {{ $status->name }}
          </option>
        @endforeach
      </select>
    </div>
    <button type="submit" type="button" class="btn btn-dark">
      <i class="fas fa-search"></i>
    </button>
  </form>
</div>
<table class="table table-hover table-bordered table-responsive-xl">
  <thead>
    <th style="width: 50px">ID</th>
    <th>Khách hàng</th>
    <th>Người duyệt đơn</th>
    <th>Người giao</th>
    <th>Trạng thái</th>
    <th>Cập nhật</th>
    <th></th>
  </thead>
  <tbody>
    {!! \App\Helpers\OrderHelper::order($orders) !!}
  </tbody>
</table>
{!! $orders->links('pagination::bootstrap-5') !!}
@endsection
