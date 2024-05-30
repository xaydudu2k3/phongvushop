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
        <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm">
      </div>
      <div class="form-group col-md-6">
        <label for="producttype_id">Loại sản phẩm</label>
        <select name="producttype_id" class="form-control form-select">
          @foreach ($producttypes as $producttype)
          <option value="{{ $producttype->id }}">{{ $producttype->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="trademark_id">Thương hiệu</label>
        <select name="trademark_id" class="form-control form-select">
          @foreach ($trademarks as $trademark)
          <option value="{{ $trademark->id }}">{{ $trademark->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="promotion_id">Loại khuyến mãi</label>
        <select name="promotion_id" class="form-control form-select">
          @foreach ($promotions as $promotion)
          <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label>Giá tiền</label>
        <input type="number" class="form-control" name="price" placeholder="Nhập giá tiền sản phẩm">
      </div>
      <div class="form-group col-md-6">
        <label for="quantity">Số lượng</label>
        <input type="number" class="form-control" name="quantity" placeholder="Nhập số lượng sản phẩm">
      </div>
    </div>
    <div class="form-group">
      <label>Mô Tả</label>
      <textarea name="description" class="form-control"></textarea>
    </div>
    <div class="form-group">
      <label>Mô Tả Sản phẩm</label>
      <textarea id="content" name="content" class="form-control"></textarea>
    </div>
    <div class="form-group">
      <label>Ảnh sản phẩm</label>
      <input type="file" class="form-control" id="upload">
      <div id="image_show" class="mt-3"></div>
      <input type="hidden" name="thumb" id="thumb">
    </div>
    {{-- <div class="form-group">
      <label>Ảnh sản phẩm</label>
      <div class="row" id="image_preview"></div>
      <div class="input-group mt-3">
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="upload" accept="image/*" multiple>
          <label class="custom-file-label" for="upload">Tải ảnh lên...</label>
        </div>
      </div>
    </div> --}}
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-success">Tạo sản phẩm</button>
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
