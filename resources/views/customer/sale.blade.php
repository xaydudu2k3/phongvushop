@extends('customer.layout.main')
@section('main')
    <section class="main-sale">
        <div class="container">
            <h2 class="mb-3">Mã giảm giá</h2>
            <div class="sale-list row">
                @foreach ($sales as $sale)
                    <div class="p-2 col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card border-info alert alert-info p-0">
                            <div class="card-body">
                                <h5 class="card-title mb-2"><b>{{ $sale->name }}</b></h5>
                                <h6 class="card-subtitle mb-2 text-danger" id="sale-id{{ $sale->id }}">{{ $sale->token }}
                                </h6>
                                <p class="card-text">Mã được áp dụng trên tổng hóa đơn</p>
                                <button type="button" class="btn-sale" style="transition: 0.3s;"
                                    {{ $sale->quantity == 0 ? 'disabled' : '' }}>Sao chép</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
