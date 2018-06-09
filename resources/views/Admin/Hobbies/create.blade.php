@extends('layouts.admin')

@section('content')
    <form enctype="multipart/form-data" method="POST" action="{{route('HobbiesStore')}}">
        @include('Admin.Hobbies._form')
        <button class="btn btn-dark" type="submit">Ajouter</button>
    </form>
@endsection
