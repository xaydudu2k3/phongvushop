@extends('admin.main')

@section('content')
    <form action="" method="post">
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">Tên nhân viên</label>
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên nhân viên">
                </div>
                <div class="form-group col-md-6">
                    <label for="usertype_id">Giới tính</label>
                    <div class="d-flex w-25 justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender_male" value="1"
                                checked>
                            <label class="form-check-label" for="gender_male">
                                Nam
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="gender_female" value="0">
                            <label class="form-check-label" for="gender_female">
                                Nữ
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="usertype_id">Loại nhân viên</label>
                    <select name="usertype_id" class="form-control form-select">
                        @foreach ($usertypes as $usertype)
                            <option value="{{ $usertype->id }}">{{ $usertype->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="name">CCCD</label>
                    <input type="text" class="form-control" name="cccd" placeholder="Nhập CCCD nhân viên">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" placeholder="Nhập sđt nhân viên">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Nhập email nhân viên">
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Mật khẩu</label>
                    <input type="text" class="form-control" name="password" placeholder="Nhập mật khẩu nhân viên">
                </div>
            </div>
            <div class="form-group">
                <label>Ảnh nhân viên</label>
                <input type="file" class="form-control" id="upload">
                <div id="image_show" class="mt-3"></div>
                <input type="hidden" name="thumb" id="thumb">
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-success">Tạo nhân viên</button>
            <a href="/admin/users/list" class="btn btn-secondary">Quay lại</a>
        </div>
        @csrf
    </form>
@endsection
