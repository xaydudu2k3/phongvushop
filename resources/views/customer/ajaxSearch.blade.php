@foreach ($data as $pro)
<a href="{{ url('/product', $pro->id) }}">
  <div class="card mx-2 my-2">
    <div class="row g-0">
      <div class="col-3 list-search-img">
        <img src="{{ $pro->thumb }}" class="img-fluid rounded-start" alt="{{ $pro->name }}">
      </div>
      <div class="col-9">
        <div class="card-body">
          <p class="card-text"><small>{{ $pro->name }}</small></p>
        </div>
      </div>
    </div>
  </div>
</a>
@endforeach
