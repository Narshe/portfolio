{{ csrf_field() }}

<div class="form-group">
  <label for="name">Nom</label>
  <input value="{{$school->name}}" class="form-control" type="text" name="name" id="name" />
</div>
<div class="form-group">
  <label for="city">City</label>
  <input value="{{$school->city}}" class="form-control" type="text" name="city" id="city" />
</div>
<div class="form-group">
  <label for="date_begin">Date de début</label>
  <input class="form-control date" type="text" name="date_begin" id="date_begin" value="{{$school->date_begin}}" />
</div>
<div class="form-group">
  <label for="date_end">Date de fin </label>
  <input class="form-control date" type="text" name="date_end" id="date_end" value="{{$school->date_end}}" />
</div>
<div class="form-group">
  <label for="url">Url</label>
  <input class="form-control" type="text" name="url" id="url" value="{{$school->url}}" />
</div>
<div class="form-group">
  <label for="description">Description</label>
  <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$school->description}}
  </textarea>
</div>
