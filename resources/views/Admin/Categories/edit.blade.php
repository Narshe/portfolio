@extends('layouts.admin')
@section('content')

  <form class="form-group" method="POST" action="{{route('CategoriesUpdate', $category->id)}}">
    {{ method_field('PATCH')}}
    @include('Admin.Categories._form',  ['item' => $category])
    <button type="submit" class="btn btn-dark">Editer</button>
  </form>
@endsection
