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
    <label for="description">Description</label>
    <textarea class="form-control" name="description" id="description">{{ $hobby->description}}</textarea>
</div>

<div class="form-group">
    <label for="icon">Icon</label>
    <input type="text" class="form-control" name="icon" id="icon" value="{{$hobby->icon}}" />
</div>

<div class="custom-control custom-checkbox">
    <input {{$hobby->visible ? 'checked' :  '' }} id="checkbox" type="checkbox" name="visible" value="visible" class="custom-control-input">
    <label class="custom-control-label" for="checkbox">Mettre en ligne</label>
</div>
