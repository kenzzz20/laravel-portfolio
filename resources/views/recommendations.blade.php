@extends('layouts.app')
@section('title', 'Recommendations')
@section('content')
    @include('partials.page-head', ['title' => 'Recommendations', 'sub' => 'Kind words from people I’ve worked with.'])
    <div class="py-8">@include('partials.recos', ['items' => config('portfolio.recommendations')])</div>
@endsection