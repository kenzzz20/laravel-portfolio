@extends('layouts.app')
@section('title', 'Stack')
@section('content')
    @include('partials.page-head', ['title' => 'Stack', 'sub' => 'Tools I use every day.'])
    <div class="py-8">@include('partials.stack', ['items' => config('portfolio.skills')])</div>
@endsection