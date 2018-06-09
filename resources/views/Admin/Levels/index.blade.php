@extends('layouts.admin')

@section('content')

    <table class="table">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Valeur</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($levels as $level)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $level->name }}</td>
          <td>{{ $level->value }}</td>
          <td class="col-sm-4 col-md-3 col-lg-3 col-xl-3">
            <a class="btn btn-info" href="{{route('LevelsEdit', $level->id)}}">Editer</a>
            <form style="display:inline" method="POST" action="{{route('LevelsDestroy', $level->id)}}">
              {{ csrf_field() }}
              {{ method_field('DELETE')}}
              <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
    </table>
    <a class="btn btn-dark" href="{{route('LevelsCreate')}}">Création d'un niveau</a>

@endsection
