@extends('admin.main')

@section('content')
<form action="" method="post">
  <div class="card-body">
    <div class="row">
      <div class="form-group col-md-6">
        <label>Tên mã giảm giá</label>
        <input type="text" class="form-control" name="name" value="{{ $sale->name }}" placeholder="Nhập tên mã giảm giá">
      </div>
      <div class="form-group col-md-6">
        <label>Mã giảm giá</label>
        <input type="text" class="form-control" name="token" value="{{ $sale->token }}" placeholder="Nhập mã giảm giá">
      </div>
      <div class="form-group col-md-6">
        <label>Số lượng mã giảm giá</label>
        <input type="number" class="form-control" name="quantity" value="{{ $sale->quantity }}" placeholder="Nhập số lượng mã giảm giá">
      </div>
      <div class="form-group col-md-6">
        <label>Số giảm giá</label>
        <input type="text" class="form-control" name="sale" value="{{ $sale->sale }}" placeholder="Nhập số mã giảm giá">
      </div>
    </div>
    <div class="form-group">
      <label>Kích hoạt</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" value="1" type="radio" id="active" name="active" {{ $sale->active == 1 ? 'checked' : '' }}>
        <label for="active" class="custom-control-label">Có</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" {{ $sale->active == 0 ? 'checked' : '' }}>
        <label for="no_active" class="custom-control-label">Không</label>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Cập Nhật mã giảm giá</button>
    <a href="/admin/sales/list" class="btn btn-secondary">Quay lại</a>
  </div>
  @csrf
</form>

@endsection

