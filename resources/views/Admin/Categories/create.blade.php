@extends('layouts.admin')

@section('content')

<form class="form-horizontal col-md-7" role="form" method="POST" action="{{ route('CategoriesStore') }}">

    @include('Admin.Categories._form',  ['item' => $category])

    <button class="btn btn-dark" type="submit">Ajouter</button>

</form>

@endsection
