<div class="container">
    <div class="row">
        <div class="col-12 section-title presentation-title">
            <h1>Culture</h1>
        </div>
    </div>
    <!--
    <div style="text-align:center;" class="row justify-content-center">
        @foreach ($hobbies as $key => $hobby)
            <hobby :hobby="{{ $hobby }}"></hobby>
        @endforeach
    </div>
    -->
    <div class="row culture-sort">
        <div class="col-12 col-lg-2">
            <button type="button" class="btn culture-btn active col-10 col-lg-10" data-button-type="all">
                Tous
            </button>
        </div>
        @foreach ($hobbies as $key => $hobby)
            <div class="col-5 col-lg-2">
                <button type="button" class="btn culture-btn col-10 col-lg-10" data-button-type="{{$hobby->icon}}">
                    {{ $hobby->name }}
                </button>
            </div>
        @endforeach
    
    </div>
    <div class="row culture-items">
       
        @foreach ($hobbies as $key => $hobby)
           
            @foreach($hobby->getDescription() as $k => $description)
                <span class="badge badget badge-dark" data-culture-type="{{$hobby->icon}}">{{ $description }}</span>
            @endforeach
        @endforeach
    </div>
   
</div>
