@extends('admin.main')

@section('content')
    <div class="row d-flex justify-content-md-between mb-3">
        <form method="GET" action="/admin/users/list" class="input-group rounded col-md-8 w-auto align-items-center">
            <div class="form-outline">
                <input type="search" class="form-control rounded" placeholder="Tìm kiếm" aria-label="Search"
                    aria-describedby="search-addon" name="search" id="search-user" />
            </div>
            <button type="submit" type="button" class="btn btn-dark">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <div class="text-md-right col-md-4">
            <a href="/admin/users/add" class="btn-sm btn btn-success text-decoration-none">
                <div class="p-1">
                    <i class="fa-solid fa-plus"></i> Thêm nhân viên
                </div>
            </a>
        </div>
    </div>
    <table class="table table-hover table-bordered table-responsive">
        <thead>
            <th style="width: 50px">ID</th>
            <th>Tên nhân viên</th>
            <th>Loại nhân viên</th>
            <th>Giới tính</th>
            <th>CCCD</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ảnh</th>
            <th>Cập nhật</th>
            <th style="width: 100px;"></th>
        </thead>
        <tbody>
            {!! \App\Helpers\UserHelper::user($users) !!}
        </tbody>
    </table>
    {!! $users->links('pagination::bootstrap-5') !!}
@endsection
