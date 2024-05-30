@extends('admin.main')

@section('content')
    <div class="text-right mb-3">
        <a href="/admin/sliders/add" class="btn-sm btn btn-success text-decoration-none">
            <div class="p-1">
                <i class="fa-solid fa-plus"></i> Thêm slider
            </div>
        </a>
    </div>
    <table class="table table-hover table-bordered table-responsive-xl">
        <thead>
            <th style="width: 50px">ID</th>
            <th>Tiêu đề</th>
            <th>Mô tả</th>
            <th>Đường dẫn</th>
            <th>Ảnh</th>
            <th>Trạng thái</th>
            <th>Cập nhật</th>
            <th style="width: 100px;"></th>
        </thead>
        <tbody>
            {!! \App\Helpers\SliderHelper::slider($sliders) !!}
        </tbody>
    </table>
    {!! $sliders->links('pagination::bootstrap-5') !!}
@endsection
