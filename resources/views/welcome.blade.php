@extends('layouts.app')

@php
    $p = config('portfolio');

    // Profile hover gallery: Profile.png (default) | Profile(2).png | Profile(3).png
    $profileGallery = array_values(array_filter(
        ['images/Profile.png', 'images/Profile(2).png', 'images/Profile(3).png'],
        fn ($path) => file_exists(public_path($path))
    ));
    $hasPhoto = count($profileGallery) > 0;
@endphp

@section('content')
{{-- Intro --}}
<section id="intro" class="scroll-mt-24 pb-8 pt-10 sm:pt-14 lg:pt-20">
    <div class="grid items-center gap-8 lg:grid-cols-12 lg:gap-16">

        {{-- Photo --}}
        <div class="mx-auto w-full max-w-xs sm:max-w-sm lg:col-span-5 lg:mx-0 lg:max-w-none xl:col-span-4">
            <div class="group/photo w-full rounded-2xl border-2 border-base-content/20 bg-base-200 p-2 shadow-lg transition-shadow duration-300 group-hover/photo:shadow-2xl">
                @if ($hasPhoto)
                    <figure class="hover-gallery aspect-[4/5] w-full overflow-hidden rounded-xl bg-base-200">
                        @foreach ($profileGallery as $i => $img)
                            <img
                                src="{{ asset($img) }}"
                                alt="{{ $p['name'] }}{{ $i ? ' — view ' . ($i + 1) : '' }}"
                                class="h-full w-full object-cover"
                                @if ($i === 0) loading="eager" fetchpriority="high" @else loading="lazy" @endif
                            >
                        @endforeach
                    </figure>
                @else
                    <div class="flex aspect-[4/5] w-full items-center justify-center rounded-xl bg-base-200 font-mono text-6xl text-base-content/60 sm:text-7xl">KM</div>
                @endif
            </div>
        </div>

        {{-- Text --}}
        <div class="text-center lg:col-span-7 lg:text-left xl:col-span-8">
            <h1 class="font-mono text-3xl leading-tight tracking-tight text-base-content sm:text-4xl md:text-5xl xl:text-7xl">{{ $p['name'] }}</h1>
            <p class="mx-auto mt-5 max-w-2xl text-base leading-relaxed sm:text-lg lg:mx-0 xl:text-xl">I'm a full-stack web developer and UI designer. I build with Laravel, Tailwind CSS, Alpine.js, and MySQL.</p>
            <p class="mx-auto mt-3 max-w-2xl text-base leading-relaxed sm:text-lg lg:mx-0 xl:text-xl">I love turning rough ideas into things people actually use.</p>

            <div class="mt-6 flex flex-wrap justify-center gap-x-4 gap-y-2 font-mono text-xs sm:text-sm lg:justify-start">
                @foreach ($p['socials'] as [$l, $u])
                    <a href="{{ $u }}" target="_blank" rel="noreferrer" class="link link-hover hover:text-base-content">{{ $l }} ↗</a>
                @endforeach
            </div>

            <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row lg:justify-start">
                <a href="{{ route('projects') }}" class="btn btn-neutral px-6">View Projects</a>
                <a href="#contact" class="btn btn-outline border-base-content/30 bg-transparent text-base-content hover:border-base-content hover:bg-base-content/5">Get in Touch</a>
            </div>
        </div>
    </div>

    {{-- Collab chips --}}
    <div class="mt-10 flex flex-wrap items-center justify-center gap-3 lg:justify-start">
        @foreach ($p['collabs'] as $c)
            <a href="{{ $c['url'] }}" target="_blank" rel="noreferrer" class="flex items-center gap-2 rounded-full border border-base-content/10 bg-base-200/40 py-1.5 pl-1.5 pr-4 font-mono text-xs transition hover:border-base-content/25">
                <span class="flex h-6 w-6 items-center justify-center rounded-full bg-base-content text-[10px] text-base-100">{{ strtoupper(substr($c['name'], 0, 1)) }}</span>
                <span class="text-base-content">{{ $c['name'] }}</span><span class="text-base-content/50">{{ $c['role'] }}</span>
            </a>
        @endforeach
    </div>

    {{-- Stats --}}
    <div class="mt-10 grid grid-cols-3 divide-x divide-base-content/10 border-y border-base-content/10 text-center lg:text-left">
        @foreach ([['300K+', 'community'], ['3+ yrs', 'shipping'], ['11x', 'hackathon wins']] as [$v, $l])
            <div class="px-4 py-5 first:pl-0">
                <div class="font-mono text-xl text-base-content sm:text-3xl">{{ $v }}</div>
                <div class="mt-1 font-mono text-[10px] uppercase tracking-wider text-base-content/50 sm:text-xs">{{ $l }}</div>
            </div>
        @endforeach
    </div>
</section>

<x-section num="01" title="blog" :href="route('blog')" more="all posts →">
    @include('partials.posts', ['items' => array_slice($p['posts'], 0, 3)])
</x-section>

<x-section num="02" title="projects" :href="route('projects')" more="all projects →">
    @include('partials.projects', ['items' => array_slice($p['projects'], 0, 3)])
</x-section>

<x-section num="03" title="experience" :href="route('experience')" more="full history →">
    @include('partials.experience', ['items' => array_slice($p['experience'], 0, 4)])
    <div class="mb-4 mt-10 flex items-end justify-between">
        <h3 class="font-mono text-lg text-base-content">Stack</h3>
        <a href="{{ route('stack') }}" class="link link-hover font-mono text-xs sm:text-sm">view all →</a>
    </div>
    @include('partials.stack', ['items' => array_slice($p['skills'], 0, 12)])
</x-section>

<x-section num="04" title="certifications" :href="route('certifications')" more="all certifications →">
    @include('partials.certs', ['items' => array_slice($p['certifications'], 0, 3)])
</x-section>

<x-section num="05" title="recommendations" :href="route('recommendations')" more="all recommendations →">
    @include('partials.recos', ['items' => array_slice($p['recommendations'], 0, 3)])
</x-section>

<x-section num="06" title="affiliations" :href="route('affiliations')" more="all affiliations →">
    @include('partials.affil', ['items' => array_slice($p['affiliations'], 0, 3)])
</x-section>

<x-section num="07" title="github">
    <div class="mb-3 flex justify-end">
        <a href="https://github.com/{{ $p['github'] }}" target="_blank" rel="noreferrer" class="link link-hover font-mono text-sm">@KENZZZ20 ↗</a>
    </div>
    <div class="overflow-x-auto rounded-xl border border-base-content/10 bg-base-200/40 p-4">
        <img src="https://ghchart.rshah.org/{{ $p['github'] }}" alt="GitHub contributions" class="min-w-[640px]" loading="lazy">
    </div>
</x-section>

<x-section title="hackathons">
    @include('partials.hackathons', ['items' => $p['hackathons']])
</x-section>

{{-- Contact --}}
<section id="contact" class="scroll-mt-24 py-10 sm:py-14">
    <div class="rounded-2xl border border-base-content/10 bg-base-200/50 p-6 sm:p-8 lg:p-12">
        <p class="font-mono text-xs uppercase tracking-wider text-base-content/50">Get in touch</p>
        <h2 class="mt-2 font-mono text-2xl text-base-content xl:text-4xl">say hello</h2>
        <p class="mt-3 max-w-xl">For work, collabs, or just to say hi — drop me a line.</p>
        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">
            <div class="join w-full sm:w-auto">
                <input readonly value="{{ $p['email'] }}" aria-label="Email" class="input join-item w-full border-base-content/20 bg-transparent font-mono text-sm sm:w-72">
                <button type="button" id="copy-email" data-email="{{ $p['email'] }}" class="btn btn-neutral join-item font-mono">Copy</button>
            </div>
            <a href="mailto:{{ $p['email'] }}" class="btn btn-outline border-base-content/30 bg-transparent text-base-content hover:border-base-content hover:bg-base-content/5">Open mail app</a>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.getElementById('copy-email')?.addEventListener('click', async (e) => {
        const b = e.currentTarget;
        try { await navigator.clipboard.writeText(b.dataset.email); b.textContent = 'Copied ✓'; }
        catch { b.textContent = 'Ctrl+C'; }
        setTimeout(() => b.textContent = 'Copy', 1800);
    });
</script>
@endpush
@endsection