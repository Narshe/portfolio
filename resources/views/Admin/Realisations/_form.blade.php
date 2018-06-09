{{ csrf_field() }}

<div class="form-group">
    <label for="name">Nom de la réalisation</label>
    <input class="form-control" type="text" name="name" id="name" value="{{$realisation->name}}" />
</div>
<div class="form-group">
    <label for="company">Nom de l'entreprise </label>
    <input class="form-control" type="text" name="company" id="company" value="{{$realisation->company}}" />
</div>
<div class="form-group">
    <label for="date_begin">Date de début</label>
    <input class="form-control date" type="text" name="date_begin" id="date_begin" value="{{$realisation->date_begin}}" />
</div>
<div class="form-group">
    <label for="date_end">Date de fin </label>
    <input class="form-control date" type="text" name="date_end" id="date_end" value="{{$realisation->date_end}}" />
</div>
<div class="form-group">
    <label for="position">Position dans l'entreprise </label>
    <input class="form-control" type="text" name="position" id="position" value="{{$realisation->position}}" />
</div>
<div class="form-group">
    <label for="url">Site de l'entreprise </label>
    <input class="form-control file0" type="text" name="url" id="url" value="{{$realisation->url}}" />
</div>
<div class="form-group file">
    <label for="file">Files </label>
    <div class="file-buttons">
        <button class="btn btn-dark" id="add" type="button" name="button">+</button>
        <button class="btn btn-dark" id="remove" type="button" name="button">-</button>
    </div>
    <input class="form-control" type="file" name="files[]" id="url" value="{{$realisation->url}}" />
</div>
<div class="form-group">
    <label for="realisations-skills">Compétences utilisées pour ce projet </label>
    <select class="form-control realisations-skills" name="skills[]" multiple="">
        @foreach($skillsGrouped as $key => $skillGrouped)
            <optgroup label="{{$key}}">
                @foreach($skillGrouped as $k => $skill)
                    @if(in_array($skill->id, $realisation->skills->pluck('id')->toArray()))
                       <option selected value="{{$skill->id}}">{{$skill->name}}</option>
                    @else
                       <option value="{{$skill->id}}">{{$skill->name}}</option>
                    @endif
                @endforeach
           </optgroup>
      @endforeach
  </select>
</div>

<div class="form-group">
  <label for="category_id"> Categories </label>
  <select id="category_id" name="category_id" class="form-control">
      @foreach($experiencesCategories as $key => $type)
          @if($type->id == $realisation->category_id)
            <option selected value="{{ $type->id }}"> {{ $type->name }} </option>
          @else
            <option value="{{ $type->id }}"> {{ $type->name }} </option>
          @endif
      @endforeach
  </select>
</div>

<div class="form-group">
    <label class="custom-control custom-checkbox">
    <input {{$realisation->visible ? 'checked' :  '' }} type="checkbox" name="visible" value="visible" class="custom-control-input">
    <span class="custom-control-indicator"></span>
    <span class="custom-control-description">Mettre en ligne</span>
  </label>
</div>
