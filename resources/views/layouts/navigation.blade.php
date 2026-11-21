{{-- Sidebar: ginagamit ng layouts/app.blade.php via @include('layouts.navigation')
     Kailangan ang $p, $label, $links galing sa app.blade.php --}}
<div class="drawer-side z-40 lg:w-[72px] lg:overflow-visible">
    <label for="nav-drawer" class="drawer-overlay" aria-label="Close menu"></label>

    <aside id="sidebar" class="group/sidebar flex h-dvh min-h-0 w-72 flex-col overflow-hidden border-r border-base-content/10 bg-base-100 transition-[width,box-shadow] duration-300 ease-in-out hover:shadow-2xl focus-within:shadow-2xl lg:fixed lg:inset-y-0 lg:left-0 lg:z-50 lg:w-[72px] lg:hover:w-72 lg:focus-within:w-72">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="flex shrink-0 items-center gap-3 px-5 font-mono text-base font-medium text-base-content lg:px-[22px]">
            <span class="logo flex shrink-0 items-center justify-center rounded-md bg-base-content text-xs text-base-100">KM</span>
            <span class="{{ $label }}">{{ $p['name'] }}</span>
        </a>

        {{-- Nav groups + dividers --}}
        <nav class="mt-[clamp(.4rem,1.6dvh,1rem)] shrink-0 px-3 font-mono" aria-label="Sections">
            @php
                // Alisin ang walang laman na groups para walang doble o magkadikit na divider
                $groups = collect($p['nav'])->map(fn ($g) => array_values((array) $g))->filter(fn ($g) => count($g))->values();
            @endphp
            @foreach ($groups as $group)
                @unless ($loop->first) <div class="sep h-px bg-base-content/10" role="separator"></div> @endunless
                <ul class="flex flex-col">
                    @foreach ($group as [$text, $route])
                        @php $active = request()->routeIs($route) || ($route === 'blog' && request()->routeIs('post')); @endphp
                        <li>
                            <a href="{{ route($route) }}" title="{{ $text }}" @if ($active) aria-current="page" @endif
                               class="nav-item transition-colors hover:bg-base-200/60 hover:text-base-content {{ $active ? 'text-base-content' : 'text-base-content/60' }}">
                                <x-icon :name="$route" />
                                <span class="{{ $label }}">{{ $text }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach

            {{-- Plain text links (Projects, Experience...) --}}
            @if (count($links))
                <div class="opt-links lg:hidden lg:group-hover/sidebar:block lg:group-focus-within/sidebar:block">
                    <div class="sep h-px bg-base-content/10" role="separator"></div>
                    <ul class="flex flex-col">
                        @foreach ($links as [$text, $href])
                            <li><a href="{{ $href }}" class="plain-link text-base-content/60 transition-colors hover:text-base-content">{{ $text }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </nav>

        {{-- Bottom (laging nasa baba) --}}
        <div class="mt-auto shrink-0 px-3 pt-2 font-mono">

            {{-- Ask / Typing --}}
            <button type="button" data-open-ask class="nav-item w-full text-left text-base-content/60 transition-colors hover:bg-base-200/60 hover:text-base-content">
                <x-icon name="ask" />
                <span class="{{ $label }} flex flex-1 items-center justify-between gap-2">Ask anything
                    <span class="flex items-center gap-1"><kbd class="kbd kbd-xs">Alt</kbd><span class="text-base-content/40">+</span><kbd class="kbd kbd-xs">K</kbd></span>
                </span>
            </button>
            <button type="button" data-open-typing class="nav-item w-full text-left text-base-content/60 transition-colors hover:bg-base-200/60 hover:text-base-content">
                <x-icon name="typing" />
                <span class="{{ $label }} flex flex-1 items-center justify-between gap-2">Typing test
                    <span class="flex items-center gap-1"><kbd class="kbd kbd-xs">Alt</kbd><span class="text-base-content/40">+</span><kbd class="kbd kbd-xs">J</kbd></span>
                </span>
            </button>

            <div class="sep h-px bg-base-content/10" role="separator"></div>

            {{-- Viewers --}}
            <div class="opt-viewers nav-item small-text text-base-content/60">
                <div id="v-avatars" class="avatars flex shrink-0 -space-x-2" aria-hidden="true"></div>
                <span class="{{ $label }}"><b id="v-count" class="text-base-content">1</b> <span id="v-noun">person</span> viewing now</span>
            </div>

            <div class="sep h-px bg-base-content/10" role="separator"></div>

            {{-- Theme switcher + sound --}}
            <div class="my-[clamp(.2rem,1dvh,.6rem)] flex items-center justify-center gap-2 lg:flex-col lg:group-hover/sidebar:flex-row lg:group-focus-within/sidebar:flex-row">
                <div class="flex w-fit flex-col items-center gap-0.5 rounded-full border border-base-content/10 p-0.5 lg:group-hover/sidebar:flex-row lg:group-focus-within/sidebar:flex-row" role="group" aria-label="Theme">
                    @foreach (['system' => 'System', 'light' => 'Light', 'dark' => 'Dark'] as $key => $text)
                        <button type="button" data-theme-btn="{{ $key }}" class="theme-btn text-base-content/50 transition-colors hover:text-base-content" aria-label="{{ $text }} theme" title="{{ $text }}">
                            <x-icon :name="$key" class="h-4 w-4" />
                        </button>
                    @endforeach
                </div>
                <button type="button" id="sound-btn" class="theme-btn border border-base-content/10 text-base-content/50 transition-colors hover:text-base-content lg:hidden lg:group-hover/sidebar:inline-flex lg:group-focus-within/sidebar:inline-flex" aria-label="Typing sounds" aria-pressed="false" title="Typing sounds">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M11 5 6 9H3v6h3l5 4V5Z"/><path data-on class="hidden" d="M15.5 8.5a5 5 0 0 1 0 7M18.5 5.5a9 9 0 0 1 0 13"/><path data-off d="m16 9 5 6m0-6-5 6"/></svg>
                </button>
            </div>

            <p class="opt-tagline small-text px-3 text-base-content/50 {{ $label }}">For work, collabs &amp; everything else, reach me at</p>
            <a href="mailto:{{ $p['email'] }}" class="opt-email nav-item small-text text-base-content hover:underline">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                <span class="{{ $label }} truncate">{{ $p['email'] }}</span>
            </a>
        </div>
    </aside>
</div>