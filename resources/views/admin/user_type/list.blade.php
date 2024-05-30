@extends('admin.main')

@section('content')
    <div class="text-right mb-3">
        <a href="/admin/user_types/add" class="btn-sm btn btn-success text-decoration-none">
            <div class="p-1">
                <i class="fa-solid fa-plus"></i> Thêm loại nhân viên
            </div>
        </a>
    </div>
    <table class="table table-hover table-bordered table-responsive-xl">
        <thead>
            <th style="width: 50px">ID</th>
            <th>Tên nhân viên</th>
            <th>Cập nhật</th>
            <th style="width: 100px;"></th>
        </thead>
        <tbody>
            {!! \App\Helpers\UserTypeHelper::user_type($user_types) !!}
        </tbody>
    </table>
    {!! $user_types->links('pagination::bootstrap-5') !!}
@endsection
