@if ($errors->any())
<div class="pt-3 alert-error">
  <div class="alert alert-danger mb-0">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
</div>
@endif

@if(Session::has('error'))
<div class="pt-3">
  <div class="alert alert-danger mb-0">
    {!! Session::get('error') !!}
  </div>
</div>
@endif

@if(Session::has('success'))
<div class="pt-3 dislay-success">
  <div class="alert alert-success mb-0">
    {!! Session::get('success') !!}
  </div>
</div>
@endif
