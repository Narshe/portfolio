{{ csrf_field() }}

<div class="form-group">
  <label for="type">Type</label>
  <input value="{{$media->type}}" class="form-control" type="text" name="type" id="type" />
</div>
<div class="form-group">
  <label for="alt">Alt</label>
  <input class="form-control" type="text" name="alt" id="alt" value="{{$media->alt}}" />
</div>
<div class="form-group">
  <label for="mediable_type">Appartient à</label>
  <input class="form-control" type="text" name="mediable_type" id="mediable_type" value="{{$media->mediable_type}}" />
</div>
