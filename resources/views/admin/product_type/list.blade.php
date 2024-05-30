@extends('admin.main')

@section('content')
<div class="row d-flex justify-content-md-between mb-3">
  <form method="GET" action="/admin/product_types/list" class="input-group rounded col-md-8 w-auto align-items-center">
    <div class="form-outline">
      <input type="search" class="form-control rounded" placeholder="Tìm kiếm" aria-label="Search" aria-describedby="search-addon" name="search" id="search-producttype" />
    </div>
    <button type="submit" type="button" class="btn btn-dark">
      <i class="fas fa-search"></i>
    </button>
  </form>
  <div class="text-md-right col-md-4">
    <a href="/admin/product_types/add" class="btn-sm btn btn-success text-decoration-none">
      <div class="p-1">
        <i class="fa-solid fa-plus"></i> Thêm loại sản phẩm
      </div>
    </a>
  </div>
</div>
<table class="table table-hover table-bordered table-responsive-xl">
  <thead>
    <th style="width: 50px">STT</th>
    <th>Tên loại sản phẩm</th>
    <th>Ảnh</th>
    <th>Active</th>
    <th>Cập nhật</th>
    <th style="width: 100px;"></th>
  </thead>
  <tbody>
    {!! \App\Helpers\ProductTypeHelper::product_type($product_types) !!}
  </tbody>
</table>
{!! $product_types->links('pagination::bootstrap-5') !!}
@endsection
