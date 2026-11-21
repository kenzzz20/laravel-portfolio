@extends('layouts.app')
@section('title', 'Consulting')
@section('content')
    @include('partials.page-head', ['title' => 'Consulting', 'sub' => 'Need help shipping a product? Let’s talk.'])
    <div class="grid gap-4 py-8 md:grid-cols-3">
        @foreach (config('portfolio.services') as $s)
            <div class="rounded-xl border border-base-content/10 bg-base-200/40 p-6">
                <h3 class="font-mono text-base font-semibold text-base-content">{{ $s['title'] }}</h3>
                <p class="mt-2 text-sm text-base-content/65">{{ $s['desc'] }}</p>
            </div>
        @endforeach
    </div>
    <a href="mailto:{{ config('portfolio.email') }}?subject=Consulting" class="btn btn-neutral mb-10">Book a call</a>
@endsection