@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{route('LevelsUpdate', $level->id)}}">
        @include('Admin.Levels._form')
        {{ method_field('PATCH')}}
        <button class="btn btn-dark" type="submit">Modifier</button>
    </form>
@endsection
