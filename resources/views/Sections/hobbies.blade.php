<div class="container">
    <div class="row">
        <div class="col-12 section-title presentation-title">
            <h1>Loisirs</h1>
        </div>
    </div>
    <div style="text-align:center;" class="row justify-content-center">
        @foreach ($hobbies as $key => $hobby)
            <hobby :hobby="{{ $hobby }}"></hobby>
        @endforeach
    </div>
</div>
