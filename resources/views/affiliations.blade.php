@extends('layouts.app')
@section('title', 'Affiliations')
@section('content')
    @include('partials.page-head', ['title' => 'Affiliations'])
    <div class="py-8">@include('partials.affil', ['items' => config('portfolio.affiliations')])</div>
@endsection