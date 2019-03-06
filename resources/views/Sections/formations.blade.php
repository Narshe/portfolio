<div class="container">
    <div class="row">
        <div class="col-12 section-title presentation-title">
            <h1><span class="section-title-icon"><i class="fa fa-graduation-cap fa-x3" aria-hidden="true"></i></span>Formations</h1>
        </div>
    </div>
   <!-- <div class="row schools">
        <div class="col-12">
            <div class="row">
                @foreach ($schools as $school)
                    <div class="col-12 schools-item">
                        <div class="row justify-content-center align-items-center ">
                            <div class="col-8 col-sm-4 col-md-3 col-lg-2 years bg-dark ">
                                <div class="row align-items-center schools-years">
                                    <div class="col-12">
                                        <h4>{{$school->date_end->format('Y')}}</h4>
                                        <h4>{{$school->date_begin->format('Y')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 col-sm-4 col-md-3 col-lg-2 years bg-dark collapse">
                                <div class="row align-items-center schools-years">
                                    <div class="col-12">
                                        <h4>{{$school->date_end->format('Y')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4 offset-sm-2 offset-md-2 offset-lg-3 school-informations bg-dark text-white">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>{{$school->name}}</h4>
                                    </div>
                                    <div class="col-12 school-information">
                                        <div class="row">
                                            <div class="col-4 school-information-title">
                                                Ville
                                            </div>
                                            <div class="col-8 school-information-content">
                                                {{ $school->city }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 school-information">
                                        <div class="row">
                                            <div class="col-4 school-information-title">
                                                Description
                                            </div>
                                            <div class="col-8 school-information-content">
                                                {{ $school->description }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @if ($loop->last)
                                <div class="col-8 col-sm-4 col-md-3 col-lg-2 years bg-dark collapse">
                                    <div class="row align-items-center schools-years" >
                                        <div class="col-12">
                                            <h4>{{$school->date_begin->format('Y')}}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div> -->
    <div class="row schools">

        <span class="timeline-start fa fa-graduation-cap"></span>
        <span class="timeline"></span>
        <span class="timeline-end"></span>
        <div class="col-12">
            @foreach ($schools as $school)
                <div class="row school-item">    
                    <div class="col-12 col-md-6 ">
                        <div class="row align-items-center row-formation">
                            <div class="card card-formation col-12 col-md-8 text-white bg-dark">
                                <div class="card-header">Ecole blabla</div>
                                <div class="card-body">
                                    <h5 class="card-title">Primary card title</h5>
                                    <p class="card-text">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium dignissimos repudiandae assumenda id ut. Commodi natus, labore, culpa, impedit beatae nam nesciunt hic corporis odit at iste. Expedita, cum! Commodi!
                                    </p>
                                </div>
                            </div>
                                    
                            <div class="timeline-link col-12 col-md-4">
                                <div class="years">
                                    <div class="end-year">
                                        {{$school->date_end->format('Y')}}
                                    </div>
                                    <figure class="formation-figure"></figure>
                                    <div class="start-year">
                                        {{$school->date_begin->format('Y')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>       
                </div>      
            @endforeach   
        </div>
    </div>
</div>
