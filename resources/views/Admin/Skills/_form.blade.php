{{ csrf_field() }}

<div class="form-group">
  <label for="name"> Name </label>
  <input class="form-control" type="text" name="name" id="name" value="{{$skill->name}}" />
</div>

<div class="form-group">
  <label for="url"> Link </label>
  <input class="form-control" type="text" name="url" id="url" value="{{$skill->url}}"/>
</div>

<div class="form-group">
  <label for="level_id"> Levels </label>
  <select id="level_id" name="level_id" class="form-control">
      @foreach($levels as $key => $level)
          @if($key == $skill->level_id)
            <option selected value="{{ $key }}"> {{ $level }} </option>
          @else
            <option value="{{ $key }}"> {{ $level }} </option>
          @endif
      @endforeach
  </select>
</div>

<div class="form-group">
  <label for="category_id"> Categories </label>
  <select id="category_id" name="category_id" class="form-control">
      @foreach($skillCategories as $key => $type)
          @if($key == $skill->category_id)
            <option selected value="{{ $key }}"> {{ $type }} </option>
          @else
            <option value="{{ $key }}"> {{ $type }} </option>
          @endif
      @endforeach
  </select>
</div>

<div class="form-group">
  <label for="description"> Description </label>
  <textarea id="description" name="description" cols="30" rows="10" class="form-control">@foreach ($skill->getDescriptions() as $description){{ $description }},@endforeach
  </textarea>
</div>

<div class="form-group">
  <label for="media"> Image: </label>
  <input class="form-control" type="file" name="media" id="media">
</div>

<div class="custom-control custom-checkbox">
    <input {{$skill->visible ? 'checked' :  '' }} id="checkbox" type="checkbox" name="visible" value="visible" class="custom-control-input">
    <label class="custom-control-label" for="checkbox">Mettre en ligne</label>
</div>
