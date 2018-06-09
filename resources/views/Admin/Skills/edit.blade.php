@extends('layouts.admin')

@section('content')

  <form enctype="multipart/form-data" method="POST" action="{{route('SkillsUpdate', $skill->id)}}">
    {{ method_field('PATCH')}}
    @include('Admin.Skills._form')
    <button class="btn btn-dark" type="submit">Modifier</button>
  </form>

@endsection
