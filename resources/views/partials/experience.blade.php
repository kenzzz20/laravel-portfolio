<ul class="divide-y divide-base-content/10 border-y border-base-content/10">
    @foreach ($items as $e)
        <li class="flex items-baseline gap-6 py-4 font-mono sm:gap-10">
            <span class="w-12 shrink-0 text-xs text-base-content/50 sm:text-sm">{{ $e['year'] }}</span>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-base-content sm:text-base">{{ $e['role'] }}</p>
                <p class="text-xs text-base-content/60 sm:text-sm">{{ $e['org'] }}</p>
            </div>
        </li>
    @endforeach
</ul>