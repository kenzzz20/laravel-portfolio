<div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
    @foreach ($items as $p)
        <article class="group card overflow-hidden rounded-xl border border-base-content/10 bg-base-200/40 shadow-none transition duration-300 hover:-translate-y-1 hover:border-base-content/25">
            <figure class="relative aspect-video overflow-hidden bg-base-200">
                <img src="{{ $p['image'] }}" alt="{{ $p['title'] }}" loading="lazy" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                @if ($p['badge'])
                    <div class="badge badge-sm absolute bottom-3 left-3 border-white/10 bg-black/50 text-white">{{ $p['badge'] }}</div>
                @endif
            </figure>
            <div class="card-body p-5">
                <h3 class="card-title font-mono text-base text-base-content">{{ $p['title'] }}</h3>
                <p class="text-sm text-base-content/65">{{ $p['desc'] }}</p>
                <div class="mt-1 flex flex-wrap gap-2">
                    @foreach ($p['tags'] as $t)
                        <span class="badge badge-sm badge-outline border-base-content/20 text-base-content/80">{{ $t }}</span>
                    @endforeach
                </div>
                <div class="card-actions mt-auto gap-4 pt-3 font-mono text-sm">
                    <a href="{{ $p['demo'] }}" class="link link-hover text-base-content">live demo ↗</a>
                    <a href="{{ $p['repo'] }}" class="link link-hover text-base-content/60">github ↗</a>
                </div>
            </div>
        </article>
    @endforeach
</div>