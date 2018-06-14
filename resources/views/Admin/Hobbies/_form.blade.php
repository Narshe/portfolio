{{ csrf_field() }}

<div class="form-group">
    <label for="name">Nom du hobby</label>
    <input class="form-control" type="text" name="name" id="name" value="{{$hobby->name}}" />
</div>
<div class="form-group">
    <label for="url">Url</label>
    <input class="form-control" type="text" name="url" id="url" value="{{$hobby->url}}" />
</div>
<div class="form-group">
  <label for="category_id"> Categories </label>
  <select id="category_id" name="category_id" class="form-control">
      @foreach($hobbyCategories as $key => $type)
          @if($type->id == $hobby->category_id)
            <option selected value="{{ $type->id }}"> {{ $type->name }} </option>
          @else
            <option value="{{ $type->id }}"> {{ $type->name }} </option>
          @endif
      @endforeach
  </select>
</div>

{{-- <div class="form-group">
  <label for="media"> Image: </label>
  <input class="form-control" type="file" name="media" id="media">
</div> --}}

<div class="custom-control custom-checkbox">
    <input {{$hobby->visible ? 'checked' :  '' }} id="checkbox" type="checkbox" name="visible" value="visible" class="custom-control-input">
    <label class="custom-control-label" for="checkbox">Mettre en ligne</label>
</div>
