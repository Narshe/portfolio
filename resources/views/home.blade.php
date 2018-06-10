@extends('layouts.app')

@section('content')

    <section id="presentation" class="presentation">
        @include('Sections.presentation')
    </section>

    <section id="skills" class="skills">
        @include('Sections.skills', ['$skillsWithCategories' =>  $skillsWithCategories])
    </section>

    <section id="experiences" class="experiences">
        @include('Sections.experiences', ['realisationsWithCategories' => $realisationsWithCategories])
    </section>

    <section id="formations" class="formations">
        @include('Sections.formations', ['schools' => $schools])
    </section>

    <section id="hobbies" class="hobbies">
        @include('Sections.hobbies')
    </section>
{{--
    <section id="contact" class="contact">
        @include('layouts._flash')
        @include('Sections.contact')
    </section> --}}

@endsection
