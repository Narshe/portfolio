@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Réalisations</li>
                </ol>
            </div>
        </div>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Entreprise</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Position</th>
                    <th>Compétences</th>
                    <th>Url</th>
                    <th>Visible</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($realisations as $realisation)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $realisation->name }}</td>
                    <td>{{ $realisation->company }}</td>
                    <td>{{ $realisation->date_begin->format('Y-m-d')}}</td>
                    <td>{{ $realisation->date_end->format('Y-m-d') }}</td>
                    <td>{{ $realisation->position }}</td>
                    <td>
                        @foreach($realisation->skills as $skill)
                            <span class="badge badge-dark">{{ $skill->name}}</span>
                        @endforeach
                    </td>
                    <td><a target="_blank" href="{{ $realisation->url }}">{{ $realisation->name }}</a></td>
                    <td>
                        @if($realisation->visible) Oui @else Non @endif
                    </td>
                    <td>
                        <a class="btn btn-info" href="{{route('RealisationsEdit', $realisation->id)}}">Editer</a>
                        <form style="display:inline" method="POST" action="{{route('RealisationsDestroy', $realisation->id)}}">
                            {{ csrf_field() }} {{ method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <a class="btn btn-dark" href="{{route('RealisationsCreate')}}">Création d'une réalisation</a>
    </div>
</div>
@endsection
