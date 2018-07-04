@extends('layouts.admin')

@section('content')

    <table class="table table-bordered">
    {{-- <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Email</th>
        <th>Contenu</th>
        <th>Actions</th>
      </tr>
    </thead> --}}
        <tbody>
            <tr>
                <td>Email</td>
                <td>{{ $contact->email }}</td>
            </tr>
            <tr>
                <td>Nom</td>
                <td>{{ $contact->lastname ? $contact->lastname : 'Non renseigné'}}</td>
            </tr>
            <tr>
                <td>Prénom</td>
                <td>{{ $contact->firstname ? $contact->firstname : 'Non renseigné' }}</td>
            </tr>
            <tr>
                <td>Contenu</td>
                <td>{{ $contact->content }}</td>
            </tr>

        </tbody>
    </table>

    <form method="POST" action="{{route('ContactsDestroy', $contact->id)}}">
      {{ csrf_field() }}
      {{ method_field('DELETE')}}
      <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
@endsection
