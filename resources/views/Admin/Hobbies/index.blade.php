@extends('layouts.admin')

@section('content')

    <table class="table">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Nom</th>
        <th>Url</th>
        <th>Description</th>
        <th>Visible</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($hobbies as $hobby)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $hobby->name }}</td>
          <td >{{ $hobby->url }}</td>
          <td>
              @foreach ($hobby->getDescription() as $hobbyDescription)
                <span class="badge badge-dark ml-1">{{ $hobbyDescription }}</span>
              @endforeach
          </td>
          <td>{{ ($hobby->visible) ? 'Oui' : 'Non'}} </td>
          <td>
            <a class="btn btn-info" href="{{route('HobbiesEdit', $hobby->id)}}">Editer</a>
            <form style="display:inline" method="POST" action="{{route('HobbiesDestroy', $hobby->id)}}">
              {{ csrf_field() }}
              {{ method_field('DELETE')}}
              <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
    </table>
    <a class="btn btn-dark" href="{{route('HobbiesCreate')}}">Création d'un hobby</a>

@endsection
