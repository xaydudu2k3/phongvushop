@extends('admin.main')

@section('content')
    <!-- /.card-header -->
    <!-- form start -->
    <div class="text-right mb-3">
        <a href="/admin/menus/add" class="btn-sm btn btn-success text-decoration-none">
            <div class="p-1">
                <i class="fa-solid fa-plus"></i> Thêm Danh Mục
            </div>
        </a>
    </div>
    <table class="table table-hover table-bordered table-responsive-xl">
        <thead>
            <th style="width: 50px">ID</th>
            <th>Name</th>
            <th>URL</th>
            <th>Active</th>
            <th>Update</th>
            <th style="width: 100px;"></th>
        </thead>
        <tbody>
            {!! \App\Helpers\MenuHelper::menu($menus) !!}
        </tbody>
    </table>
@endsection
