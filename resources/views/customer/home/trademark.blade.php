<section class="main-trademark">
  <div class="container">
    <h2 class="mb-5"><b>Thương hiệu</b></h2>
    <div class="slide-trademark" data-aos="fade-up">
      @foreach ($trademarks as $key => $trademark) 
      <div class="trademark">
        <a href="{{ $trademark->url }}" class="text-center">
          <div class="trademark-img">
            <img src="{{ $trademark->thumb }}" alt="{{ $trademark->name }}">
          </div>
          <p>{{ $trademark->name }}</p>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>