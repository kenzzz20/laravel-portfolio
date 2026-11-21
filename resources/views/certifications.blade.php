@extends('layouts.app')
@section('title', 'Certifications')
@section('content')
    @include('partials.page-head', ['title' => 'Certifications'])
    <div class="py-8">@include('partials.certs', ['items' => config('portfolio.certifications')])</div>
@endsection