<div class="grid gap-4 sm:grid-cols-2">
    @foreach ($items as $r)
        <blockquote class="flex flex-col justify-between rounded-xl border border-base-content/10 bg-base-200/40 p-5">
            <p class="text-sm leading-relaxed text-base-content/80">“{{ $r['quote'] }}”</p>
            <footer class="mt-4 border-t border-base-content/10 pt-3 font-mono">
                <p class="text-xs font-semibold text-base-content sm:text-sm">{{ $r['who'] }}</p>
                <p class="text-xs text-base-content/50">{{ $r['title'] }}</p>
            </footer>
        </blockquote>
    @endforeach
</div>