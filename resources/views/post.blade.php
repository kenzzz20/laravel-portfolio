@extends('layouts.app')
@section('title', $post['title'])
@section('description', $post['excerpt'])
@section('content')
    <article class="mx-auto max-w-3xl py-10 sm:py-14">
        <a href="{{ route('blog') }}" class="link link-hover font-mono text-sm">← all posts</a>
        <h1 class="mt-6 font-mono text-3xl tracking-tight text-base-content sm:text-4xl">{{ $post['title'] }}</h1>
        <p class="mt-2 font-mono text-xs text-base-content/50">{{ $post['date'] }}</p>
        <div class="mt-8 space-y-5 text-base leading-relaxed text-base-content/80">
            @foreach (explode("\n\n", $post['body']) as $para)
                <p>{{ $para }}</p>
            @endforeach
        </div>
    </article>
@endsection