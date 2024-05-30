@extends('admin.main')

@section('content')
    <div class="row d-flex justify-content-lg-between mb-3">
        <form method="GET" action="/admin/products/list" class="input-group rounded col-lg-3 w-auto align-items-center">
            <div class="form-outline">
                <input type="search" class="form-control rounded" placeholder="Tìm kiếm" aria-label="Search"
                    aria-describedby="search-addon" name="search" id="search-product" />
            </div>
            <button type="submit" type="button" class="btn btn-dark">
                <i class="fas fa-search"></i>
            </button>
        </form>
        <form role="search" method="get" action="/admin/products/list" class="row col-lg-7">
            <div class="form-group mb-0 d-flex align-items-center justify-content-around col-lg-5">
                <label class="mb-0">Loại sản phẩm: </label>
                <select name="producttype_id" class="form-control form-select w-50">
                    <option value="">Chọn ()</option>
                    @foreach ($producttypes as $producttype)
                        <option value="{{ $producttype->id }}"
                            {{ $producttype->id == request()->input('producttype_id') ? 'selected' : '' }}>
                            {{ $producttype->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-0 d-flex align-items-center justify-content-around col-lg-5">
                <label class="mb-0">Thương hiệu: </label>
                <select name="trademark_id" class="form-control form-select w-50">
                    <option value="">Chọn ()</option>
                    @foreach ($trademarks as $trademark)
                        <option value="{{ $trademark->id }}"
                            {{ $trademark->id == request()->input('trademark_id') ? 'selected' : '' }}>
                            {{ $trademark->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" type="button" class="btn btn-dark col-lg-1">
                <i class="fa-regular fa-filter"></i>
            </button>
        </form>
        <div class="text-lg-right col-lg-2">
            <a href="/admin/products/add" class="btn-sm btn btn-success text-decoration-none">
                <div class="p-1">
                    <i class="fa-solid fa-plus"></i> Thêm sản phẩm
                </div>
            </a>
        </div>
    </div>
    <table class="table table-hover table-bordered table-responsive">
        <thead>
            <th style="width: 50px">STT</th>
            <th>Tên sản phẩm</th>
            <th>Loại sản phẩm</th>
            <th>Thương hiệu</th>
            <th>Số lượng</th>
            <th>Ảnh</th>
            <th>Giá gốc</th>
            <th>Giá giảm</th>
            <th>Cập nhật</th>
            <th style="width: 100px;"></th>
        </thead>
        <tbody>
            {!! \App\Helpers\ProductHelper::product($products) !!}
        </tbody>
    </table>
    {!! $products->links('pagination::bootstrap-5') !!}
@endsection
