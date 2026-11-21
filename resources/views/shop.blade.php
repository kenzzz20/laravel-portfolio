@extends('layouts.app')
@section('title', 'Shop')
@section('content')
    @include('partials.page-head', ['title' => 'Shop', 'sub' => 'Templates and tools I made.'])
    <div class="py-8">@include('partials.cards', ['items' => config('portfolio.shop')])</div>
@endsection