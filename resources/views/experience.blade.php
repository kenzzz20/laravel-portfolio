@extends('layouts.app')
@section('title', 'Experience')
@section('content')
    @include('partials.page-head', ['title' => 'Experience', 'sub' => 'Where I’ve worked.'])
    <div class="py-8">@include('partials.experience', ['items' => config('portfolio.experience')])</div>
@endsection