@extends('layouts.app')
@section('title', 'Collabs')
@section('content')
    @include('partials.page-head', ['title' => 'Collabs', 'sub' => 'Brands and communities I work with.'])
    <div class="py-8">@include('partials.collabs', ['items' => config('portfolio.collabs')])</div>
@endsection