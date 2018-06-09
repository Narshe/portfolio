@extends('layouts.admin')

@section('content')

  <table class="table table-inverse">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Type</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($categories as $category)
        <tr>
          <th scope="row">{{ $loop->iteration }}</th>
          <td>{{ $category->name }}</td>
          <td>{{ $category->type }}</td>
          <td>
            <a class="btn btn-info" href="{{route('CategoriesEdit', $category->id)}}">Editer</a>
            <form style="display:inline" method="POST" action="{{route('CategoriesDestroy', $category->id)}}">
              {{ csrf_field() }}
              {{ method_field('DELETE')}}
              <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
          </td>
        </tr>
      @endforeach

    </tbody>
  </table>

  <a class="btn btn-dark"  href="{{route('CategoriesCreate')}}">Création d'une catégorie</a>
@endsection
