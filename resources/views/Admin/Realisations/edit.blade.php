@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item"><a href="{{ route('Realisations') }}">Réalisations</a></li>
        <li class="breadcrumb-item active">Editer</li>
    </ol>
    <form enctype="multipart/form-data" id="realisationForm" class="realisationForm" action="{{route('RealisationsUpdate', $realisation->id)}}" method="POST">
        {{ method_field('PATCH')}}
        @include('Admin.Realisations._form')
        <button class="btn btn-dark" type="submit">Modifier</button>
    </form>

@endsection
