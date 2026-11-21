<div class="divide-y divide-base-content/10 border-y border-base-content/10">
    @foreach ($items as $post)
        <a href="{{ route('post', $post['slug']) }}" class="group block py-5 transition hover:bg-base-200/30 sm:px-3">
            <div class="flex items-baseline justify-between gap-4 font-mono">
                <h3 class="text-base font-semibold text-base-content group-hover:underline">{{ $post['title'] }}</h3>
                <span class="shrink-0 text-xs text-base-content/50">{{ $post['date'] }}</span>
            </div>
            <p class="mt-1 text-sm text-base-content/65">{{ $post['excerpt'] }}</p>
        </a>
    @endforeach
</div>