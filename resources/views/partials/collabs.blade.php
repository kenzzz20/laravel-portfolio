<div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($items as $c)
        <a href="{{ $c['url'] }}" target="_blank" rel="noreferrer" class="flex items-center gap-3 rounded-xl border border-base-content/10 bg-base-200/40 p-4 transition hover:border-base-content/25">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-base-content font-mono text-sm text-base-100">{{ strtoupper(substr($c['name'], 0, 1)) }}</span>
            <div class="font-mono">
                <p class="text-sm font-semibold text-base-content">{{ $c['name'] }}</p>
                <p class="text-xs text-base-content/50">{{ $c['role'] }}</p>
            </div>
        </a>
    @endforeach
</div>