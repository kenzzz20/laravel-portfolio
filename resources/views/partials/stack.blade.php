@php
    // skill => [simple-icons slug, brand color (hex, walang #)]
    $skills = [
        'Laravel 12'         => ['laravel',        'FF2D20'],
        'PHP 8.3'            => ['php',            '777BB4'],
        'MySQL'              => ['mysql',          '4479A1'],
        'REST APIs'          => ['postman',        'FF6C37'],
        'Tailwind CSS'       => ['tailwindcss',    '06B6D4'],
        'daisyUI'            => ['daisyui',        '5A0EF8'],
        'Alpine.js'          => ['alpinedotjs',    '8BC0D0'],
        'Blade'              => ['laravel',        'FF2D20'],
        'Vite'               => ['vite',           '646CFF'],
        'Git'                => ['git',            'F05032'],
        'UI Design'          => ['figma',          'F24E1E'],
        'Responsive Layouts' => ['css3',           '1572B6'],
        'Figma'              => ['figma',          'F24E1E'],
        'Adobe Photoshop'    => ['adobephotoshop', '31A8FF'],
        'Capcut'             => ['capcut',         'E5E7EB'],
    ];
@endphp

<style>
    [x-cloak] { display: none !important; }

    .skill-chip {
        --x: 50%; --y: 50%;
        --brand: #22d3ee;
    }
    .skill-chip:hover {
        border-color: color-mix(in srgb, var(--brand) 55%, transparent);
        box-shadow:
            0 8px 24px -8px color-mix(in srgb, var(--brand) 45%, transparent),
            inset 0 1px 0 0 rgb(255 255 255 / .06);
    }
    .skill-chip .spotlight {
        background: radial-gradient(
            110px circle at var(--x) var(--y),
            color-mix(in srgb, var(--brand) 28%, transparent),
            transparent 70%
        );
    }
    .skill-chip:hover .icon-chip {
        background: color-mix(in srgb, var(--brand) 16%, transparent);
        --tw-ring-color: color-mix(in srgb, var(--brand) 50%, transparent);
    }

    @keyframes chip-in {
        from { opacity: 0; transform: translateY(8px) scale(.96); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    @media (prefers-reduced-motion: no-preference) {
        .skill-chip { animation: chip-in .5s cubic-bezier(.22,1,.36,1) both; }
    }
</style>

<ul class="flex flex-wrap gap-2 sm:gap-2.5" role="list">
    @foreach ($items as $s)
        @php
            [$slug, $color] = $skills[$s] ?? ['codepen', '22D3EE'];
        @endphp

        <li
            x-data="{ failed: false }"
            @mousemove="
                const r = $el.getBoundingClientRect();
                $el.style.setProperty('--x', ($event.clientX - r.left) + 'px');
                $el.style.setProperty('--y', ($event.clientY - r.top) + 'px');
            "
            style="--brand: #{{ $color }}; animation-delay: {{ $loop->index * 45 }}ms"
            class="skill-chip group relative inline-flex cursor-default select-none items-center gap-2.5
                   overflow-hidden rounded-full border border-base-content/10 bg-base-200/40
                   py-1.5 pl-1.5 pr-4 font-mono text-xs text-base-content/70 backdrop-blur
                   transition-all duration-300 ease-out
                   hover:-translate-y-0.5 hover:text-base-content sm:text-sm"
        >
            {{-- cursor-following spotlight --}}
            <span class="spotlight pointer-events-none absolute inset-0 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span>

            {{-- icon chip --}}
            <span class="icon-chip relative grid h-7 w-7 shrink-0 place-items-center rounded-full
                         bg-base-content/5 ring-1 ring-base-content/10 transition-all duration-300">
                <img
                    x-show="!failed"
                    x-on:error="failed = true"
                    src="https://cdn.simpleicons.org/{{ $slug }}/{{ $color }}"
                    alt=""
                    loading="lazy"
                    width="16" height="16"
                    class="h-4 w-4 opacity-50 grayscale transition-all duration-300
                           group-hover:rotate-[8deg] group-hover:scale-110 group-hover:opacity-100 group-hover:grayscale-0"
                >

                {{-- fallback: unang letra, kulay ng brand --}}
                <span
                    x-show="failed" x-cloak
                    class="text-[11px] font-bold leading-none"
                    style="color: #{{ $color }}"
                >{{ Str::upper(Str::substr($s, 0, 1)) }}</span>
            </span>

            <span class="relative whitespace-nowrap tracking-tight">{{ $s }}</span>
        </li>
    @endforeach
</ul>