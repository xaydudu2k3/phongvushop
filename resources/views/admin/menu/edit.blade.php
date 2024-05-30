@extends('admin.main')

@section('content')
    <form action="" method="post">
        <div class="card-body">

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="menu">Tên Danh Mục</label>
                    <input type="text" class="form-control" name="name" value="{{ $menu->name }}" id="menu"
                        placeholder="Nhập tên danh mục">
                </div>

                <div class="form-group col-md-6">
                    <label>Danh Mục</label>
                    <select name="parent_id" class="form-control">
                        <option value="0" {{ $menu->parent_id == 0 ? 'selected' : '' }}>Chọn menu gốc (hoặc không)
                        </option>
                        @foreach ($menus as $menuchild)
                            <option value="{{ $menuchild->id }}" {{ $menu->parent_id == $menuchild->id ? 'selected' : '' }}>
                                {{ $menuchild->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="menu">Đường dẫn</label>
                <input type="text" class="form-control" name="url" value="{{ $menu->url }}" id="menu"
                    placeholder="Nhập đường dẫn danh mục">
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $menu->active == 1 ? 'checked' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $menu->active == 0 ? 'checked' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập Nhật Danh Mục</button>
            <a href="/admin/menus/list" class="btn btn-secondary">Quay lại</a>
        </div>
        @csrf
    </form>
@endsection
