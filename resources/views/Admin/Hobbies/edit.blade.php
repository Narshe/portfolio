@extends('layouts.admin')

@section('content')
    <form enctype="multipart/form-data" method="POST" action="{{route('HobbiesUpdate', $hobby->id)}}">
        @include('Admin.Hobbies._form')
        {{ method_field('PATCH')}}
        <button class="btn btn-dark" type="submit">Modifier</button>
    </form>
@endsection
