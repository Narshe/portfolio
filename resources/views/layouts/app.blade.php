<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">

    <title>Hadrien Giraudeau - Cv en ligne</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

  </head>

  <body id="page-top">

      <nav id="navbar" class="navbar navbar-expand-lg fixed-top bg-dark">
          <a style="text-align:center" class="navbar-brand col-12 col-md-2" href="#">Hadrien Giraudeau</a>
          <div class="navbar-collapse col-12 col-md-8 col-lg-10" id="navbarNav">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item presentation">
                      <span class="small-size collapse col-2">
                          <a class="nav-link" href="#presentation">
                            <i class="fa fa-user fa-2x" aria-hidden="true"></i>
                          </a>
                      </span>
                      <span class="regular-size">
                          <a class="nav-link" href="#presentation">Présentation
                          </a>
                      </span>
                  </li>
                  <li class="nav-item skills">
                      <span class="small-size collapse col-2">
                          <a class="nav-link" href="#skills">
                            <i class="fa fa-code fa-2x" aria-hidden="true"></i>
                          </a>
                      </span>
                      <span class="regular-size">
                          <a class="nav-link" href="#skills">Compétences
                          </a>
                      </span>
                  </li>
                  <li class="nav-item experiences">
                      <span class="small-size collapse col-2">
                          <a class="nav-link" href="#experiences">
                            <i class="fa fa-briefcase fa-2x" aria-hidden="true"></i>
                          </a>
                      </span>
                      <span class="regular-size">
                          <a class="nav-link" href="#experiences">Expériences
                          </a>
                      </span>
                  </li>
                  <li class="nav-item formations">
                      <span class="small-size collapse col-2">
                          <a class="nav-link" href="#formations">
                            <i class="fa fa-graduation-cap fa-2x" aria-hidden="true"></i>
                          </a>
                      </span>
                      <span class="regular-size">
                          <a class="nav-link" href="#formations">Formations
                          </a>
                      </span>
                  </li>
                  <li class="nav-item hobbies">
                      <span class="small-size collapse col-2">
                          <a class="nav-link" href="#hobbies">
                            <i class="fa fa-code fa-2x" aria-hidden="true"></i>
                          </a>
                      </span>
                      <span class="regular-size">
                          <a class="nav-link" href="#hobbies">Loisirs
                          </a>
                      </span>
                  </li>
                  <li class="nav-item contact">
                      <span class="small-size collapse col-2">
                          <a class="nav-link" href="#contact">
                            <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
                          </a>
                      </span>
                      <span class="regular-size">
                          <a class="nav-link" href="#contact">Me contacter
                          </a>
                      </span>
                  </li>
              </ul>
          </div>
      </nav>


      <div class="container-fluid main-content">

          @yield('content')

      </div>

      <footer class="footer bg-dark text-white">
          <div class="container-fluid" style="height:100%;">
            <div class="row align-items-center justify-content-center" style="height: 100%; text-align:center">
                <div class="col-12 col-md-4 email-footer">
                    <div id="test123" class="fa test123">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        hadrien.giraudeau@gmail.com

                        <span style="position:relative" class="badge email-footer-badge text-dark">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                            <span id="email-footer-text" class="email-footer-text">Email copié</span>
                        </span>

                    </div>
                </div>
                <div class="col-12 col-md-4">
                    &copy; 2017-2018 - Tous droits réservés
                </div>
                <div class="col-12 col-md-4">
                    Encore un contenu
                </div>
            </div>
          </div>
      </footer>

  </body>
