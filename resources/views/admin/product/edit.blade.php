@extends('admin.main')

@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<form action="" method="post">
  <div class="card-body">
    <div class="row">
      <div class="form-group col-md-6">
        <label for="name">Tên sản phẩm</label>
        <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Nhập tên sản phẩm">
      </div>
      <div class="form-group col-md-6">
        <label for="promotion_id">Loại khuyến mãi</label>
        <select name="promotion_id" class="form-control form-select">
          @foreach ($promotions as $promotion)
          <option value="{{ $promotion->id }}" {{ $product->promotion_id == $promotion->id ? 'selected' : '' }}>
            {{ $promotion->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="producttype_id">Loại sản phẩm</label>
        <select name="producttype_id" class="form-control form-select">
          @foreach ($producttypes as $producttype)
          <option value="{{ $producttype->id }}" {{ $product->producttype_id == $producttype->id ? 'selected' : '' }}>
            {{ $producttype->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="trademark_id">Loại thương hiệu</label>
        <select name="trademark_id" class="form-control form-select">
          @foreach ($trademarks as $trademark)
          <option value="{{ $trademark->id }}" {{ $product->trademark_id == $trademark->id ? 'selected' : '' }}>
            {{ $trademark->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="price">Giá tiền</label>
        <input type="text" class="form-control" name="price" value="{{ $product->price }}" placeholder="Nhập giá tiền sản phẩm">
      </div>
      <div class="form-group col-md-6">
        <label for="quantity">Số lượng</label>
        <input type="text" class="form-control" name="quantity" value="{{  $product->quantity }}" placeholder="Nhập số lượng sản phẩm">
      </div>
    </div>
    <div class="form-group">
      <label>Mô Tả</label>
      <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>
    <div class="form-group">
      <label>Mô Tả Sản phẩm</label>
      <textarea id="content" name="content" class="form-control">{{ $product->content }}</textarea>
    </div>
    <div class="form-group">
      <label>Ảnh sản phẩm</label>
      <input type="file" class="form-control" id="upload">
      <div id="image_show" class="mt-3">
        <a href="{{ $product->thumb }}" target="_blank">
          <img src="{{ $product->thumb }}" width="100px">
        </a>
      </div>
      <input type="hidden" value="{{ $product->thumb }}" name="thumb" id="thumb">
    </div>
  </div>

  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Cập Nhật sản phẩm</button>
    <a href="/admin/products/list" class="btn btn-secondary">Quay lại</a>
  </div>
  @csrf
</form>

@endsection


@section('footer')
<script>
  CKEDITOR.replace('content')

</script>
@endsection
