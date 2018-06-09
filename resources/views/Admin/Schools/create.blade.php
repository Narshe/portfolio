@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item">Réalisations</li>
        <li class="breadcrumb-item active">Ajouter</li>
    </ol>
    <form id="SchoolForm" class="SchoolForm" action="{{route('SchoolsStore')}}" method="POST">
        @include('Admin.Schools._form')
        <button class="btn btn-dark" type="submit">Ajouter</button>
    </form>
@endsection
