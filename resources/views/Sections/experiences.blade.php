<div class="container">
    <div class="row">
        <div class="col-12 section-title presentation-title">
            <h1><span class="section-title-icon"><i class="fa fa-briefcase fa-x3" aria-hidden="true"></i></span>Expériences</h1>
        </div>
    </div>
    @foreach ($realisationsWithCategories as $category)

        <div class="row">
            <div class="col-12 experiences-category">
                <h4>{{ $category->name }}</h4>
            </div>
            <div class="col-12">
                <div class="row justify-content-center justify-content-md-start">
                    @foreach ($category->realisations as $realisation)
                        <div class="col-10 col-sm-6 col-lg-4 card card-experiences">

                                <div class="card-header bg-dark text-white">
                                    {{ $realisation->name }}
                                </div>
                                @if ($realisation->medias->isEmpty())
                                    <div class="card-body experience-img bg-light" style="background-image: url('{{ Storage::url('defaults/No_image_available.png') }}')">

                                    </div>
                                @else

                                    <div class="card-body experience-img bg-light" style="background-image: url('{{ asset("/storage/{$realisation->medias[0]->path}") }}')">

                                    </div>
                                @endif

                                <div style="text-align:center" class="card-body bg-dark text-white">
                                    <table class="table">
                                        <tbody>
                                            <tr class="row">
                                                <td class="col-6">Position</td>
                                                <td class="col-6">{{$realisation->position}}</td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-6">Date début</td>
                                                <td class="col-6">{{$realisation->date_begin->format('Y-m')}}</td>
                                            </tr>
                                            <tr class="row">
                                                <td class="col-6">Date fin</td>
                                                <td class="col-6">{{$realisation->date_end->format('Y-m')}}</td>
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
                                          <div class="row experiences-description-content">
                                              <div class="col-12 col-lg-5">
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
                                                         <carousel :data="{{ $realisation->medias}}"></carousel>
                                                      @endif
                                              </div>

                                              <div class="col-12 col-lg-6 text-white blablaTest">
                                                  <div class="row align-items-center justify-content-center experiences-description-small">
                                                      <div class="col-12 col-md-8">
                                                          <strong>Date de début</strong>
                                                      </div>
                                                      <div class="col-12 col-md-8">
                                                          {{$realisation->date_begin->format('Y-m-d')}}
                                                      </div>
                                                      <div class="col-12 col-md-8">
                                                          <strong>Date de fin</strong>
                                                      </div>
                                                      <div class="col-12 col-md-8">
                                                          {{$realisation->date_end->format('Y-m-d')}}
                                                      </div>
                                                      <div class="col-12 col-md-8">
                                                          <strong>Position</strong>
                                                      </div>
                                                      <div class="col-12 col-md-8">
                                                          {{$realisation->position}}
                                                      </div>
                                                      <div class="col-12 col-md-8">
                                                          <strong>Langages utilisés</strong>
                                                      </div>
                                                      <div class="col-12 col-md-8">
                                                          @foreach ($realisation->skills as $skill)
                                                            <span class="badge badge-light">{{ $skill->name }}</span>
                                                          @endforeach
                                                      </div>
                                                      <div class="col-12 col-md-8">
                                                          <strong>Description</strong>
                                                      </div>
                                                      <div class="col-12 col-md-8">
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
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
