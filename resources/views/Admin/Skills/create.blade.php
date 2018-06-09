@extends('layouts.admin')

@section('content')
  <h1>Création d'une compétence</h1>
  <form enctype="multipart/form-data" method="POST" action="{{route('SkillsStore')}}">
      @include('Admin.Skills._form')

      <button type="submit" class="btn btn-dark">Ajouter</button>
  </form>

@endsection
