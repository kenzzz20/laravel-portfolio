@extends('layouts.app')
@section('title', 'Projects')
@section('content')
    @include('partials.page-head', ['title' => 'Projects', 'sub' => 'Things I’ve built and shipped.'])
    <div class="py-8">@include('partials.projects', ['items' => config('portfolio.projects')])</div>
@endsection