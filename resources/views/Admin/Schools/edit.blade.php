@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item">Réalisations</li>
        <li class="breadcrumb-item active">Ajouter</li>
    </ol>
    <form id="SchoolForm" class="SchoolForm" action="{{route('SchoolsUpdate', $school->id)}}" method="POST">
        {{ method_field('PATCH')}}
        @include('Admin.Schools._form')
        <button class="btn btn-dark" type="submit">Modifier</button>
    </form>
@endsection
