@extends('layouts.admin')

@section('content')

    <table class="table">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Email</th>
        <th>Date</th>
        <th>Contenu</th>
        <th>Lu</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($contacts as $contact)
        <tr>

          <th scope="row">{{ $loop->iteration }}</th>
          <td><a href="{{ route('ContactsShow', $contact->id)}}">{{ $contact->email }}</a></td>
          <td>Le {{ $contact->created_at->format('Y-m-d')}} à {{ $contact->created_at->format('H:m:s')}}</td>
          <td>{{ str_limit($contact->content,50) }} </td>
          <td>
              <i class="fa fa-2x fa-fw fa-{{ $contact->is_read ? 'envelope-open' : 'envelope'}}"></i>
          </td>
          <td>
            <form style="display:inline" method="POST" action="{{route('ContactsDestroy', $contact->id)}}">
              {{ csrf_field() }}
              {{ method_field('DELETE')}}
              <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
    </table>
@endsection
