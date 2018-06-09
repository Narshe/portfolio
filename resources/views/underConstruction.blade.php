<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    <title>Hadrien Giraudeau - Cv en ligne (en construction)</title>

    <style>
        body {
            background-color: #343a40;

        }
        .img-cover {
            margin-left: calc(50% - 313px);
            margin-top: calc(25% - 113px);

        }
    </style>
  </head>

  <body>
        <div class="img-cover">
            <img src="{{ Storage::url('dev/underContruct.jpg') }}" alt="">
        </div>
  </body>
