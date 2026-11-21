<style>
    [x-cloak] { display: none !important; }

    @keyframes cert-in {
        from { opacity: 0; transform: translateY(12px) scale(.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    @media (prefers-reduced-motion: no-preference) {
        .cert-card { animation: cert-in .55s cubic-bezier(.22,1,.36,1) both; }
    }
</style>

<div
    x-data="{ open: false, src: '', title: '', issuer: '' }"
    x-effect="document.body.classList.toggle('overflow-hidden', open)"
    x-on:keydown.escape.window="open = false"
>
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($items as $c)
            <button
                type="button"
                x-on:click="open = true; src = @js(asset($c['image'])); title = @js($c['name']); issuer = @js($c['issuer'])"
                style="animation-delay: {{ $loop->index * 70 }}ms"
                class="cert-card group relative flex flex-col overflow-hidden rounded-2xl border border-base-content/10
                       bg-base-200/40 text-left backdrop-blur transition-all duration-300 ease-out
                       hover:-translate-y-1 hover:border-cyan-400/40 hover:shadow-xl hover:shadow-cyan-500/10
                       focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cyan-400"
            >
                {{-- image --}}
                <div class="relative aspect-[16/10] w-full overflow-hidden bg-base-300">
                    <img
                        src="{{ asset($c['image']) }}"
                        alt="{{ $c['name'] }}"
                        loading="lazy"
                        onerror="this.style.display='none'"
                        class="h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                    >

                    {{-- gradient overlay --}}
                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-base-300/80 via-transparent to-transparent
                                opacity-60 transition-opacity duration-300 group-hover:opacity-100"></div>

                    {{-- "View" pill --}}
                    <span class="absolute bottom-3 right-3 inline-flex items-center gap-1.5 rounded-full border border-white/15
                                 bg-black/50 px-2.5 py-1 font-mono text-[11px] text-white backdrop-blur
                                 translate-y-2 opacity-0 transition-all duration-300
                                 group-hover:translate-y-0 group-hover:opacity-100">
                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/>
                        </svg>
                        View
                    </span>

                    {{-- optional year badge --}}
                    @if (!empty($c['year']))
                        <span class="absolute left-3 top-3 rounded-full border border-white/10 bg-black/40 px-2 py-0.5
                                     font-mono text-[10px] text-white/80 backdrop-blur">
                            {{ $c['year'] }}
                        </span>
                    @endif
                </div>

                {{-- text --}}
                <div class="flex items-start gap-3 p-4 font-mono">
                    <span class="mt-0.5 grid h-7 w-7 shrink-0 place-items-center rounded-full bg-cyan-400/10 text-cyan-400
                                 ring-1 ring-cyan-400/20 transition-all duration-300
                                 group-hover:bg-cyan-400/20 group-hover:ring-cyan-400/50">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="8" r="6"/>
                            <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"/>
                        </svg>
                    </span>

                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold text-base-content transition-colors group-hover:text-cyan-300">
                            {{ $c['name'] }}
                        </p>
                        <p class="truncate text-xs text-base-content/50">{{ $c['issuer'] }}</p>
                    </div>
                </div>
            </button>
        @endforeach
    </div>

    {{-- lightbox --}}
    <div
        x-show="open" x-cloak
        x-transition.opacity.duration.200ms
        x-on:click.self="open = false"
        class="fixed inset-0 z-50 grid place-items-center bg-black/80 p-4 backdrop-blur-sm"
        role="dialog" aria-modal="true"
    >
        <figure
            x-show="open"
            x-transition:enter="transition duration-300 ease-out"
            x-transition:enter-start="scale-95 opacity-0"
            x-transition:enter-end="scale-100 opacity-100"
            class="relative w-full max-w-4xl overflow-hidden rounded-2xl border border-white/10 bg-base-200 shadow-2xl"
        >
            <button
                type="button"
                x-on:click="open = false"
                aria-label="Close"
                class="absolute right-3 top-3 z-10 grid h-8 w-8 place-items-center rounded-full bg-black/50 text-white
                       backdrop-blur transition hover:bg-black/70"
            >
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>

            <img :src="src" :alt="title" class="max-h-[75vh] w-full bg-base-300 object-contain">

            <figcaption class="border-t border-base-content/10 p-4 font-mono">
                <p class="text-sm font-semibold text-base-content" x-text="title"></p>
                <p class="text-xs text-base-content/50" x-text="issuer"></p>
            </figcaption>
        </figure>
    </div>
</div>