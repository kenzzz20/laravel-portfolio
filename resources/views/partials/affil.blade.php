<div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($items as $a)
        <a href="{{ $a['url'] }}" class="flex items-center gap-3 rounded-xl border border-base-content/10 bg-base-200/40 p-4 transition hover:border-base-content/25">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-base-content font-mono text-sm text-base-100">{{ strtoupper(substr($a['name'], 0, 1)) }}</span>
            <div class="min-w-0 font-mono">
                <p class="truncate text-sm font-semibold text-base-content">{{ $a['name'] }}</p>
                <p class="truncate text-xs uppercase tracking-wider text-base-content/50">{{ $a['role'] }}</p>
            </div>
        </a>
    @endforeach
</div>