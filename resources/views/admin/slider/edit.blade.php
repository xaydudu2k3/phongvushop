@extends('admin.main')

@section('content')
<form action="" method="post">
  <div class="card-body">

    <div class="row">
      <div class="form-group col-md-6">
        <label>Tiêu đề</label>
        <input type="text" class="form-control" name="name" placeholder="Nhập tiêu đề" value="{{ $slider->name }}" >
      </div>
      <div class="form-group col-md-6">
        <label>Đường đẫn</label>
        <input type="text" class="form-control" name="url" placeholder="Nhập đường dẫn" value="{{ $slider->url }}">
      </div>
    </div>
    <div class="form-group">
      <label>Mô Tả</label>
      <textarea name="description" class="form-control">{{ $slider->description }}</textarea>
    </div>
    <div class="form-group">
      <label>Ảnh slider</label>
      <input type="file" class="form-control" id="upload">
      <div id="image_show" class="mt-3">
        <a href="{{ $slider->thumb }}" target="_blank">
          <img src="{{ $slider->thumb }}" width="100px">
        </a>
      </div>
      <input type="hidden" name="thumb" value="{{ $slider->thumb }}" id="thumb">
    </div>
    <div class="form-group">
      <label>Kích hoạt</label>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" value="1" type="radio" id="active" name="active" {{ $slider->active == 1 ? 'checked=""' : '' }}>
        <label for="active" class="custom-control-label">Có</label>
      </div>
      <div class="custom-control custom-radio">
        <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" {{ $slider->active == 0 ? 'checked=""' : '' }}>
        <label for="no_active" class="custom-control-label">Không</label>
      </div>
    </div>
  </div>
  <!-- /.card-body -->

  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Cập Nhật Slider</button>
    <a href="/admin/sliders/list" class="btn btn-secondary">Quay lại</a>
  </div>
  @csrf
</form>
@endsection
