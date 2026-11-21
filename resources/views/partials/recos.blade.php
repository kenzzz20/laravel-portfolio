<div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
    @foreach ($items as $r)
        <figure class="flex flex-col justify-between rounded-xl border border-base-content/10 bg-base-200/40 p-5 sm:p-6">
            <blockquote class="text-sm leading-relaxed text-base-content/75">“{{ $r['quote'] }}”</blockquote>
            <figcaption class="mt-4 flex items-center gap-3 font-mono">
                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-base-content text-xs text-base-100">{{ strtoupper(substr($r['who'], 0, 1)) }}</span>
                <div class="min-w-0">
                    <p class="truncate text-sm font-semibold text-base-content">{{ $r['who'] }}</p>
                    <p class="truncate text-xs text-base-content/50">{{ $r['title'] }}</p>
                </div>
            </figcaption>
        </figure>
    @endforeach
</div>