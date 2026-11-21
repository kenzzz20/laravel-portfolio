@props(['title', 'num' => null, 'href' => null, 'more' => 'view all →'])
<section {{ $attributes->merge(['class' => 'py-10 sm:py-14']) }}>
    <div class="mb-6 flex items-end justify-between sm:mb-8">
        <h2 class="font-mono text-xl text-base-content sm:text-2xl">
            @if ($num)<span class="text-base-content/40">{{ $num }} — </span>@endif{{ $title }}
        </h2>
        @if ($href)<a href="{{ $href }}" class="link link-hover font-mono text-xs sm:text-sm">{{ $more }}</a>@endif
    </div>
    {{ $slot }}
</section>