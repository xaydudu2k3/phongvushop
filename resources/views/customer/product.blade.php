@extends('customer.layout.main')
@section('main')
    <section class="main-product">
        <div class="container">
            <h4 class="mt-5 mb-2"><b>Lọc sản phẩm</b></h4>
            <form role="search" action="/product" class="row">
                <div class="form-group d-flex align-items-center mb-4 col-lg-5">
                    <label class="me-3">Loại sản phẩm: </label>
                    <select name="producttype_id" class="form-control form-select w-75">
                        <option value="">Chọn loại sản phẩm</option>
                        @foreach ($product_types as $producttype)
                            <option value="{{ $producttype->id }}"
                                {{ $producttype->id == request()->input('producttype_id') ? 'selected' : '' }}>
                                {{ $producttype->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group d-flex align-items-center mb-4 col-lg-5">
                    <label class="me-3">Thương hiệu: </label>
                    <select name="trademark_id" class="form-control form-select w-75">
                        <option value="">Chọn thương hiệu</option>
                        @foreach ($trademarks as $trademark)
                            <option value="{{ $trademark->id }}"
                                {{ $trademark->id == request()->input('trademark_id') ? 'selected' : '' }}>
                                {{ $trademark->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group d-flex align-items-c enter mb-4 col-lg-5">
                    <label class="me-3">Từ: </label>
                    <input type="number" name="price_from" class="form-control" placeholder="Giá tối thiểu"
                        >
                </div>
                <div class="form-group d-flex align-items-center mb-4 col-lg-5">
                    <label class="me-3">Đến: </label>
                    <input type="number" name="price_to" class="form-control" placeholder="Giá tối đa">
                </div>
                <button class="btn btn-primary mb-4 col-md-2 alert alert-info py-2 p-lg-0" type="submit">
                    Lọc <i class="fa-regular fa-filter"></i>
                </button>
            </form>
            <div class="product">
                {!! \App\Helpers\ProductHelper::products($products) !!}
            </div>
            {!! $products->links('pagination::bootstrap-5') !!}
        </div>
    </section>
@endsection
