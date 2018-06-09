@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item">Réalisations</li>
        <li class="breadcrumb-item active">Ajouter</li>
    </ol>
    <form enctype="multipart/form-data" id="realisationForm" class="realisationForm" action="{{route('RealisationsStore')}}" method="POST">
        @include('Admin.Realisations._form')
        <button class="btn btn-dark" type="submit">Ajouter</button>
    </form>
@endsection
