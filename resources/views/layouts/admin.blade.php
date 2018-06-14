<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    <title>Cv en ligne - Admin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap-datepicker.css') }}">
    <script src="{{ asset('js/admin.js') }}"></script>
  </head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
          <a class="navbar-brand" href="{{route('home')}}">Aller sur le site</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-sidenav">
              @foreach ($adminMenu as $key => $menu)
                     @if ($menu['active'])
                         <li class="navbar-side-item active" data-placement="right" data-original-title="{{$menu['name']}}">
                     @else
                         <li class="navbar-side-item" data-placement="right" data-original-title="{{$menu['name']}}">
                     @endif
                     <a class="navbar-sidenav-link" href="{{route($key)}}">
                      <i class="fa fa-fw fa-{{$menu['icon']}}"></i>
                      <span class="navbar-sidenav-link-text">{{$menu['name']}}</span>
                    </a>
                  </li>
              @endforeach
            </ul>
          </div>
        </nav>

        <div class="main-content">
          <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @include('layouts._errors')
                    @include('layouts._flash')
                    @yield('content')
                </div>
            </div>
          </div>
        </div>


  </body>
