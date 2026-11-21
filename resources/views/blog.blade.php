@extends('layouts.app')
@section('title', 'Blog')
@section('content')
    @include('partials.page-head', ['title' => 'Blog', 'sub' => 'Notes on building things.'])
    <div class="py-8">@include('partials.posts', ['items' => config('portfolio.posts')])</div>
@endsection