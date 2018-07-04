@extends('layouts.admin')

@section('content')

    <table class="table">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Url</th>
        <th>Catégorie</th>
        <th>Niveau</th>
        <th>Visible</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($skills as $skill)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $skill->name }}</td>
          <td><a target="_blank" href="{{ $skill->url }}">{{ strtolower($skill->name) }}</a></td>
          <td>{{ $skill->Category->name }}</td>
          <td>{{ $skill->Level->name }}</td>
          <td>{{ $skill->visible ? 'Oui' : 'Non'}}</td>
          <td>
            <a class="btn btn-info" href="{{route('SkillsEdit', $skill->id)}}">Editer</a>
            <form style="display:inline" method="POST" action="{{route('SkillsDestroy', $skill->id)}}">
              {{ csrf_field() }}
              {{ method_field('DELETE')}}
              <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
          </td>
        </tr>
      @endforeach

    </tbody>
    </table>
    <a class="btn btn-dark" href="{{route('SkillsCreate')}}">Création d'une compétence</a>
@endsection
