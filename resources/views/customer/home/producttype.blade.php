<section class="main-menu">
  <div class="container">
    <h2 class="mb-5"><b>Loại sản phẩm</b></h2>
    <div class="menu-product">
      @foreach ($product_types as $key => $product_type) 
      <div class="menu-product-shop" data-aos="fade-up">
        <img src="{{ $product_type->thumb }}" alt="{{ $product_type->name }}">
        <div class="menu-product-info">
          <h3 style="color: #FFF;">{{ $product_type->name }}
          </h3>
          <div class="my-4">
            <form action="/product" role="search">
              <input type="hidden" name="producttype_id" value="{{ $product_type->id }}">
              <button type="submit">Xem thêm</button>
            </form>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>