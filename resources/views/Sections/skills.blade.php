<div class="container">
    <div class="row">
        <div class="col-12 section-title skills-title">
            <h1><span class="section-title-icon"><i class="fa fa-code fa-x3" aria-hidden="true"></i></span>Compétences</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 graph-legends text-dark">
            <div class="row">
            @foreach ($levels as $level)
                <div class="col-12 col-sm-4 col-md-4 level-{{$level->value}}">
                    <strong>{{$level->name}}</strong>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    @foreach ($skillsWithCategories as $category)
        <div class="row">
            <div class="col-12 skills-content">
                <div class="row">
                    <div class="col-12">
                        <h4>{{$category->name}}</h4>
                    </div>
                    @foreach ($category->skills as $skill)
                        @if ($skill->visible)
                            <div class="col-6 col-sm-5 col-md-4 col-lg-3">
                                <div class="card card-skill text-white mb-3" style="max-width: 20rem;">
                                    <span class="fa-icon">
                                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    </span>

                                     <div id="card-blur" class="bg-dark card-blur card-skill">
                                        <div class="card-header">
                                            {{ $skill->name }}
                                            @if ($skill->level->value)
                                                <span class="levels level-{{$skill->level->value}}"></span>
                                            @endif
                                        </div>

                                        <div class="card-body skill-img" style="background-image: url('{{ Storage::url($skill->media->path) }}')">

                                        </div>
                                    </div>
                                    <div id="blur" class="card-description blur">
                                        <div class="blur-content">
                                            @if ($skill->description)
                                                @foreach ($skill->description as $description)
                                                  <span class="badge badge-dark">{{ $description }}</span>
                                                @endforeach
                                            @else
                                                <strong>{{ 'Pas de description'}}</strong>
                                            @endif
                                        </div>
                                        <a target="_blank" class="btn btn-dark card-description-link" href="{{ $skill->url }}">Lien</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
