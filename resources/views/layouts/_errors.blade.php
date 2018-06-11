@if(session('errors'))
     @foreach(session('errors')->all() as $error)
      <div class="alert alert-danger" role="alert">
            <span>{{ $error }}</span>
      </div>
    @endforeach
@endif
