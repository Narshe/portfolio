@extends('layouts.admin')

@section('content')

    <form enctype="multipart/form-data" id="realisationForm" class="realisationForm" action="{{route('MediasUpdate', $media->id)}}" method="POST">
        {{ method_field('PATCH')}}
        @include('Admin.Medias._form')
        <button class="btn btn-dark" type="submit">Modifier</button>
    </form>

@endsection
