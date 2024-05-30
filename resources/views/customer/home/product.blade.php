<section class="main-product">
  <div class="container">
    <h2 class="mb-5"><b>Sản phẩm cửa hàng</b></h2>
    <div class="product">
      {!! \App\Helpers\ProductHelper::products($products) !!}
    </div>
    <div class="text-center mt-3">
      <button class="showMore">Xem thêm sản phẩm</button>
    </div>
  </div>
</section>