@extends('layouts.app')

@section('content')
    @include('sections.hero', ['hero' => $hero])
    @include('sections.education', ['educations' => $educations])
    @include('sections.certificates', ['sertifikats' => $sertifikats])
    @include('sections.experience', ['pengalaman' => $pengalaman])
    @include('sections.projects', ['projects' => $projects])
    @include('sections.articles', ['articles' => $articles])
@endsection

@push('scripts')
    @vite(['resources/js/sections/education.js'])
@endpush
