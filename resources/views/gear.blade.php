@extends('layouts.app')
@section('title', 'Gear')
@section('content')
    @include('partials.page-head', [
        'title' => 'Gear',
        'sub'   => 'The hardware and tools I use to build, create, and stay productive — my desk setup, everyday carry, and the kit I shoot content with.',
    ])

    @foreach (config('portfolio.gear') as $section)
        <section class="py-6 sm:py-10">
            {{-- Section Title --}}
            <p class="mb-4 font-mono text-[10px] uppercase tracking-widest text-base-content/50 sm:text-xs">
                {{ $section['title'] }}
            </p>

            {{-- Grid: 1 col mobile, 2 cols tablet, 3 cols desktop --}}
            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 sm:gap-4 lg:grid-cols-3">
                @foreach ($section['items'] as $item)
                    <a href="{{ $item['url'] }}" target="_blank" rel="noreferrer"
                       class="group flex flex-col overflow-hidden rounded-lg border border-base-content/10 bg-base-200/40 transition hover:-translate-y-1 hover:border-base-content/25">

                        {{-- Image Container: Mas maliit na aspect ratio at padding --}}
                        <div class="relative aspect-[16/10] overflow-hidden bg-white">
                            @if (!empty($item['image']))
                                <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}"
                                     class="h-full w-full object-contain p-4 transition duration-300 group-hover:scale-[1.03]">
                            @else
                                <div class="flex h-full items-center justify-center text-base-content/30">
                                    <x-icon name="gear" class="h-8 w-8" />
                                </div>
                            @endif
                        </div>

                        {{-- Text Content: Mas maliit na padding at font --}}
                        <div class="flex flex-1 flex-col p-3">
                            <div class="flex items-start justify-between gap-2">
                                <h3 class="font-mono text-xs font-semibold text-base-content sm:text-sm">
                                    {{ $item['name'] }}
                                </h3>
                                <span class="mt-0.5 text-base-content/40 transition-colors group-hover:text-base-content">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                </span>
                            </div>
                            <p class="mt-1 line-clamp-2 text-xs text-base-content/60">{{ $item['desc'] }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endforeach
@endsection