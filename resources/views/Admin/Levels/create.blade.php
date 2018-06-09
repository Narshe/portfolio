@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{route('LevelsStore')}}">
        @include('Admin.Levels._form')
        <button class="btn btn-dark" type="submit">Ajouter</button>
    </form>
@endsection
