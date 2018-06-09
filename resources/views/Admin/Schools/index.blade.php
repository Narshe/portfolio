@extends('layouts.admin')


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Schools</li>
                    </ol>
                </div>
            </div>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Url</th>
                        <th>Description</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schools as $school)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $school->name }}</td>
                        <td>{{ $school->city }}</td>
                        <td>{{ ($school->url) ? $school->url : 'Pas d\'url'}}</td>
                        <td>{{ $school->description }}</td>
                        <td>{{ $school->date_begin->format('Y-m-d')}}</td>
                        <td>{{ $school->date_end->format('Y-m-d')}}</td>
                        <td>
                            <a class="btn btn-info" href="{{route('SchoolsEdit', $school->id)}}">Editer</a>
                            <form style="display:inline" method="POST" action="{{route('SchoolsDestroy', $school->id)}}">
                                {{ csrf_field() }} {{ method_field('DELETE')}}
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <a class="btn btn-dark" href="{{route('SchoolsCreate')}}">Création d'une formation</a>
        </div>
    </div>
@endsection
