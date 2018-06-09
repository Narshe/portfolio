<div class="container">
    <div class="row">
        <div class="col-12 section-title presentation-title">
            <h1>Loisirs</h1>
        </div>
    </div>
    <div style="text-align:center;" class="row justify-content-center">
        @foreach ($hobbiesWithCategories as $key => $category)
            <div class="card-hobbies-container col-5 col-sm-5 col-md-5 col-lg-3 {{ $key > 0 ? 'offset-1' : '' }} ">
                <div class="row text-white">
                    <span id="fa-icon" class="fa-icon">
                        <i class="fa fa-info-circle" aria-hidden="true"></i>
                    </span>

                    <div id="card-blur" class="col-12 col-md-12 bg-dark card-blur card-hobby">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-12">
                                <h4>{{ $category->name }}</h4>
                            </div>
                            <div class="col-12 bg-dark text-white fa-icon-hobby">
                                    <i class="fa fa-{{$category->getIcons()}}" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>

                    <div id="blur" class="blur">
                        <div class="blur-content">
                            @foreach ($category->hobbies as $hobby)
                                <span class="badge badge-pill badge-dark">{{ $hobby->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
