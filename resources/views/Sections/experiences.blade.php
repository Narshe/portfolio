<div class="container">
    <div class="row">
        <div class="col-12 section-title presentation-title">
            <h1><span class="section-title-icon"><i class="fa fa-briefcase fa-x3" aria-hidden="true"></i></span>Expériences</h1>
        </div>
    </div>
    @foreach ($realisationsWithCategories as $category)

        @if ($category->realisations->count() > 0)

            <div class="row">
                <div class="col-12">
                    <h4>{{ $category->name }}</h4>
                </div>
                <div class="col-12">
                    <div class="row justify-content-center justify-content-md-start">
                        @foreach ($category->realisations as $realisation)
                            <div class="col-12 col-sm-6 col-lg-4">

                                <div class="card card-experiences">
                                    <div class="card-header bg-dark text-white">
                                        {{ $realisation->name }}
                                    </div>
                                    @if ($realisation->medias->isEmpty())
                                        <div class="card-body experience-img bg-light" style="background-image: url('{{ Storage::url('defaults/No_image_available.png') }}')">

                                        </div>
                                    @else

                                        <div class="card-body experience-img bg-light" style="background-image: url('{{ Storage::url($realisation->getCoverAttribute()->path) }}')">

                                        </div>
                                    @endif

                                    <div style="text-align:center" class="card-body bg-dark text-white">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="col-5">Position</td>
                                                    <td class="col-7">{{$realisation->position}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5">Date début</td>
                                                    <td class="col-7">{{$realisation->date_begin->format('Y-m')}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="col-5">Date fin</td>
                                                    <td class="col-7">{{$realisation->date_end->format('Y-m')}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                     </div>

                                      <div class="card-footer bg-light">
                                          @foreach ($realisation->skills as $skill)
                                              <span class="badge badge-dark">{{ $skill->name }}</span>
                                          @endforeach
                                      </div>
                                </div>
                                <div id="modal-box" class="modal-box">
                                      <div class="realisation-details bg-dark">
                                          <div class="container">
                                              <div class="row align-items-center realisation-details-name">
                                                  <div class="col-12 text-white">
                                                      <h4>{{ $realisation->name }}</h4>
                                                  </div>
                                              </div>
                                              <div class="row">
                                                  <div class="col-12 col-xl-5">
                                                      <div class="row">
                                                          @if ($realisation->medias->count() <= 1)
                                                             <div class="col-12">
                                                                 @if ($realisation->medias->isEmpty())
                                                                     <div class="experience-img bg-light" style="background-image: url('{{ Storage::url('defaults/No_image_available.png') }}')">

                                                                     </div>
                                                                 @else

                                                                     <div class="experience-img bg-light" style="background-image: url('{{ Storage::url($realisation->medias[0]->path) }}')">

                                                                     </div>

                                                                 @endif
                                                              </div>
                                                          @else
                                                             <div class="col-12 carousel">

                                                                @foreach ($realisation->medias as  $media)
                                                                    <div class="experience-img bg-light slide" style="background-image: url('{{ Storage::url($media->path) }}')">

                                                                    </div>
                                                                @endforeach
                                                                <span id="previous" class="previous">
                                                                    <i class="fa fa-chevron-left fa-2x" aria-hidden="true"></i>
                                                                </span>
                                                                <span id="next" class="next">
                                                                    <i class="fa fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                                                                </span>
                                                             </div>

                                                             <div class="col-12 bubble-box">

                                                             </div>

                                                          @endif
                                                      </div>
                                                  </div>

                                                  <div class="col-12 col-xl-6 offset-xl-1 text-white blablaTest">
                                                      <div class="row align-items-center">
                                                          <div class="col-4">
                                                              <h5>Date de début</h5>
                                                          </div>
                                                          <div class="col-7 offset-1">
                                                              {{$realisation->date_begin->format('Y-m-d')}}
                                                          </div>
                                                      </div>
                                                      <div class="row align-items-center">
                                                          <div class="col-4">
                                                              <h5>Date de fin</h5>
                                                          </div>
                                                          <div class="col-7 offset-1">
                                                              {{$realisation->date_end->format('Y-m-d')}}
                                                          </div>
                                                      </div>
                                                      <div class="row align-items-center">
                                                          <div class="col-4">
                                                              <h5>Position</h5>
                                                          </div>
                                                          <div class="col-7 offset-1">
                                                              {{$realisation->position}}
                                                          </div>
                                                      </div>
                                                      <div class="row align-items-center">
                                                          <div class="col-4">
                                                              <h5>Langages utilisés</h5>
                                                          </div>
                                                          <div class="col-7 offset-1">
                                                              @foreach ($realisation->skills as $skill)
                                                                <span class="badge badge-light">{{ $skill->name }}</span>
                                                              @endforeach

                                                          </div>
                                                      </div>
                                                      <div class="row">
                                                          <div class="col-4">
                                                              <h5>Description</h5>
                                                          </div>
                                                          <div class="col-7 offset-1">
                                                              @if ($realisation->description)

                                                                  {{$realisation->description}}
                                                              @else
                                                                  Pas de description
                                                              @endif
                                                          </div>
                                                      </div>

                                                    </div>
                                            </div>
                                        </div>
                                        <span id="realisation-details-close" class="realisation-details-close">
                                            <i class="fa fa-times-circle fa-3x" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>
