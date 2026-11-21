@extends('layouts.app')
@section('title', 'Resources')
@section('content')
    @include('partials.page-head', ['title' => 'Resources', 'sub' => 'Links worth bookmarking.'])
    <div class="py-8">@include('partials.cards', ['items' => config('portfolio.resources')])</div>
@endsection