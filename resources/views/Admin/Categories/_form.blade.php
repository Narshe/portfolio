{{ csrf_field() }}
<div class="form-group">
  <label for="name">Nom</label>
  <input value="{{$item->name}}" class="form-control" type="text" name="name" id="name" />
  <label for="type">Type</label>
  <input value="{{$item->type}}" class="form-control" type="text" name="type" id="type" />
</div>
