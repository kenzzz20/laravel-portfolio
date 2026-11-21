<div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
    @foreach ($items as $h)
        <div class="rounded-xl border border-base-content/10 bg-base-200/40 p-4 font-mono">
            <span class="badge badge-sm badge-outline border-base-content/20">{{ $h['result'] }}</span>
            <p class="mt-3 text-sm font-semibold text-base-content">{{ $h['name'] }}</p>
            <p class="text-xs text-base-content/50">{{ $h['org'] }}</p>
        </div>
    @endforeach
</div>