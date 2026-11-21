<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($items as $i)
        <a href="{{ $i['url'] }}" target="_blank" rel="noreferrer" class="group flex flex-col rounded-xl border border-base-content/10 bg-base-200/40 p-5 transition hover:-translate-y-1 hover:border-base-content/25">
            <div class="flex items-start justify-between gap-3 font-mono">
                <h3 class="text-sm font-semibold text-base-content sm:text-base">{{ $i['name'] }}</h3>
                <span class="badge badge-sm badge-outline border-base-content/20">{{ $i['tag'] }}</span>
            </div>
            <p class="mt-2 text-sm text-base-content/65">{{ $i['desc'] }}</p>
            <span class="mt-4 font-mono text-xs text-base-content/60 group-hover:text-base-content">open ↗</span>
        </a>
    @endforeach
</div>