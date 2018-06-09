{{ csrf_field() }}
<div class="form-group">
    <label for="name">Nom du niveau></label>
    <input class="form-control" type="text" name="name" id="name" value="{{$level->name}}" />
</div>
<div class="form-group">
    <label for="value">Valeur</label>
    <select class="form-control" name="value" id="value">
      @for($i=0; $i<=5; $i++)
        @if($i == $level->value)
          <option selected value="{{$i}}">{{$i}}</option>
        @else
          <option value="{{$i}}">{{$i}}</option>
        @endif
      @endfor
    </select>
</div>
