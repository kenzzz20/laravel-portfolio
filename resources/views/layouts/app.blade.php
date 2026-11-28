@php
    $p = config('portfolio');
    // Mga text na nagtatago kapag naka-collapse ang sidebar (desktop)
    $label = 'whitespace-nowrap transition-opacity duration-200 lg:opacity-0 lg:group-hover/sidebar:opacity-100 lg:group-focus-within/sidebar:opacity-100';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="night" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $p['name']) · {{ $p['name'] }}</title>
    <meta name="description"
        content="@yield('description', 'Full-Stack Web Developer & UI Designer — Laravel, Tailwind CSS, Alpine.js, MySQL.')">

    <script>
        (function () {
            try {
                var m = localStorage.getItem('theme') || 'dark';
                var d = m === 'dark' || (m === 'system' && matchMedia('(prefers-color-scheme: dark)').matches);
                document.documentElement.setAttribute('data-theme', d ? 'night' : 'light');
            } catch (e) { document.documentElement.setAttribute('data-theme', 'night'); }
        })();
    </script>

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Theme wipe animation */
        ::view-transition-old(root),
        ::view-transition-new(root) {
            animation: none;
            mix-blend-mode: normal;
        }

        ::view-transition-old(root) {
            z-index: 1;
        }

        ::view-transition-new(root) {
            z-index: 2;
            animation: theme-wipe 600ms cubic-bezier(.65, 0, .35, 1);
        }

        @keyframes theme-wipe {
            from {
                clip-path: circle(0% at var(--wipe-x, 50%) var(--wipe-y, 50%));
            }

            to {
                clip-path: circle(150% at var(--wipe-x, 50%) var(--wipe-y, 50%));
            }
        }

        @media (prefers-reduced-motion: reduce) {
            ::view-transition-new(root) {
                animation: none;
            }
        }

        /* "clip" (hindi "hidden") para hindi masira ang sticky/fixed */
        html,
        body {
            overflow-x: clip;
        }

        /* ===== Responsive Sidebar: touch-friendly sa mobile, fluid sa desktop ===== */
        #sidebar {
            --row: clamp(2.35rem, 5dvh, 2.75rem);
            --ico: 1.125rem;
            --fs: 0.875rem;
            --sep: 0.5rem;
            padding-block: 1rem;
        }

        @media (min-width: 1024px) {
            #sidebar {
                --row: clamp(1.75rem, 4.2dvh, 2.4rem);
                --ico: clamp(1rem, 2.1dvh, 1.15rem);
                --fs: clamp(.72rem, 1.55dvh, .875rem);
                --sep: clamp(.25rem, 1dvh, .6rem);
                padding-block: clamp(.75rem, 2.6dvh, 1.5rem);
            }
        }

        #sidebar .nav-item {
            display: flex;
            align-items: center;
            gap: .75rem;
            height: var(--row);
            padding-inline: .75rem;
            border-radius: .5rem;
            font-size: var(--fs);
            line-height: 1;
        }

        /* Uniform icon slot para pantay ang lahat ng icons (kasama email) sa 14" at 24" */
        #sidebar .nav-ico {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.25rem;
            height: 1.25rem;
            flex-shrink: 0;
        }

        #sidebar .nav-ico svg {
            width: var(--ico);
            height: var(--ico);
            flex-shrink: 0;
        }

        #sidebar .sep {
            margin: var(--sep) .75rem;
        }

        #sidebar .sep+.sep {
            display: none;
        }

        #sidebar .logo {
            width: 1.5rem;
            height: 1.5rem;
        }

        #sidebar .theme-btn {
            position: relative;
            z-index: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: calc(var(--row) * .9);
            height: calc(var(--row) * .9);
            border-radius: 9999px;
            flex-shrink: 0;
        }

        #sidebar .theme-btn svg {
            width: calc(var(--ico) * .9);
            height: calc(var(--ico) * .9);
        }

        /* Sliding active background indicator */
        #sidebar .theme-indicator {
            position: absolute;
            top: 0.125rem;
            left: 0.125rem;
            width: calc(var(--row) * .9);
            height: calc(var(--row) * .9);
            border-radius: 9999px;
            pointer-events: none;
            transform: translateX(calc(var(--theme-idx, 2) * (100% + 0.125rem)));
        }

        #sidebar .theme-pill.is-sliding .theme-indicator {
            transition: transform 260ms cubic-bezier(0.22, 1, 0.36, 1);
        }

        #sidebar .small-text {
            font-size: clamp(.68rem, 1.4dvh, .75rem);
            line-height: 1.35;
        }

        /* Typing test: itago sa mobile/tablet (< 1024px) */
        @media (max-width: 1023px) {
            #sidebar .desktop-only {
                display: none !important;
            }
        }

        /* Naka-collapse sa desktop: isang avatar at active theme icon lang ang makikita */
        @media (min-width: 1024px) {
            #sidebar:not(:hover):not(:focus-within) .avatars> :not(:first-child),
            #sidebar:not(:hover):not(:focus-within) .theme-pill [data-theme-btn][aria-pressed="false"],
            #sidebar:not(:hover):not(:focus-within) .sound-toggle {
                display: none;
            }

            #sidebar:not(:hover):not(:focus-within) .theme-indicator {
                transform: translateX(0) !important;
                transition: none !important;
            }
        }

        /* Pag sobrang liit ng taas sa desktop: itago ang pangalawahin */
        @media (min-width: 1024px) and (max-height: 640px) {
            #sidebar .opt-tagline {
                display: none !important;
            }
        }

        @media (min-width: 1024px) and (max-height: 540px) {
            #sidebar .opt-email {
                display: none !important;
            }
        }

        @media (min-width: 1024px) and (max-height: 460px) {
            #sidebar .opt-viewers {
                display: none !important;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-base-100 text-base-content/70 antialiased">

    <div class="drawer lg:drawer-open">
        <input id="nav-drawer" type="checkbox" class="drawer-toggle" />

        {{-- ===== Content ===== --}}
        <div class="drawer-content relative flex min-h-dvh min-w-0 flex-col">
            <div class="pointer-events-none absolute inset-x-0 top-0 -z-10 h-[24rem] opacity-60 sm:h-[32rem] [background-image:radial-gradient(circle_at_1px_1px,color-mix(in_oklab,var(--color-base-content)_25%,transparent)_1px,transparent_0)] [background-size:18px_18px] [mask-image:radial-gradient(ellipse_at_top_right,black_10%,transparent_65%)]"
                aria-hidden="true"></div>

            {{-- Mobile & Tablet header --}}
            <header
                class="navbar sticky top-0 z-30 border-b border-base-content/10 bg-base-100/80 px-4 pt-[env(safe-area-inset-top)] backdrop-blur-md sm:px-6 lg:hidden">
                <div class="navbar-start min-w-0 flex-1 gap-2.5 sm:gap-3">
                    <span
                        class="flex h-8 w-8 shrink-0 items-center justify-center rounded-md bg-base-content font-mono text-xs font-medium text-base-100">KM</span>
                    <a href="{{ route('home') }}"
                        class="truncate font-mono text-sm font-medium text-base-content sm:text-base">{{ $p['name'] }}</a>
                </div>
                <div class="navbar-end w-auto shrink-0">
                    <label for="nav-drawer" class="btn btn-ghost btn-square btn-sm sm:btn-md" aria-label="Open menu">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                </div>
            </header>

            <main class="mx-auto flex w-full max-w-[1500px] flex-1 flex-col px-4 sm:px-6 md:px-10 lg:px-14 xl:px-20">
                <div class="flex-1">
                    @yield('content')
                </div>

                <footer
                    class="mt-auto flex flex-col gap-3 border-t border-base-content/10 py-6 pb-[calc(1.5rem+env(safe-area-inset-bottom))] font-mono text-xs sm:flex-row sm:items-center sm:justify-between sm:py-10 sm:text-sm">
                    <p class="text-center text-base-content/50 sm:text-left">© {{ now()->year }} {{ $p['name'] }}</p>
                    <nav class="flex flex-wrap justify-center gap-x-4 gap-y-2 text-base-content/60 sm:justify-end sm:gap-x-5"
                        aria-label="Social links">
                        @foreach ($p['socials'] as [$l, $u])
                            <a href="{{ $u }}" target="_blank" rel="noreferrer"
                                class="link link-hover hover:text-base-content">{{ $l }} ↗</a>
                        @endforeach
                        <a href="mailto:{{ $p['email'] }}" class="link link-hover hover:text-base-content">email ↗</a>
                    </nav>
                </footer>
            </main>
        </div>

        {{-- ===== Sidebar ===== --}}
        @include('layouts.navigation')
    </div>

    {{-- ===== Alt+K: Ask anything (responsive fullscreen, blurred) ===== --}}
    <div id="ask"
        class="fixed inset-0 z-[100] hidden items-center bg-base-100/80 px-5 font-mono opacity-0 backdrop-blur-xl transition-opacity duration-300 sm:px-[5vw]"
        role="dialog" aria-modal="true" aria-label="Ask anything">
        <button type="button" data-close-overlay
            class="btn btn-ghost btn-sm btn-circle fixed top-4 right-4 text-base-content/60 hover:text-base-content sm:top-6 sm:right-6"
            aria-label="Close dialog">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="mx-auto w-full max-w-3xl">
            <form id="ask-form" class="space-y-3">
                <h2 class="font-sans text-3xl leading-tight font-medium text-base-content sm:text-5xl md:text-6xl">what do you want to ask?</h2>
                <input id="ask-input" maxlength="200" autocomplete="off" spellcheck="false" aria-label="Your question"
                    placeholder="type your question..."
                    class="w-full bg-transparent text-lg text-base-content/80 placeholder:text-base-content/25 caret-base-content outline-none sm:text-2xl">
                <p class="text-xs text-base-content/40 sm:text-sm">
                    press enter to send <span class="hidden sm:inline">· esc to close</span>
                </p>
            </form>

            <div id="ask-wait" class="hidden space-y-4">
                <p id="ask-asked"
                    class="w-fit max-w-full break-words rounded-md border border-base-content/15 bg-base-200/60 px-3 py-2 text-sm text-base-content sm:text-base">
                </p>
                <p class="flex items-center gap-2 text-base text-base-content/50 sm:text-lg">
                    <svg class="h-4 w-4 shrink-0 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M12 3a9 9 0 1 0 9 9" stroke-linecap="round" />
                    </svg>
                    <span id="ask-status" class="animate-pulse">thinking...</span>
                </p>
            </div>

            <p id="ask-line"
                class="hidden max-w-3xl font-sans text-2xl leading-snug text-base-content opacity-0 transition-opacity duration-500 sm:text-4xl md:text-5xl">
            </p>
            <p id="ask-end" class="mt-6 hidden text-xs text-base-content/40 sm:mt-8 sm:text-sm">tap anywhere or press esc to close</p>
        </div>
    </div>

    {{-- ===== Alt+J: Typing test (desktop/laptop only) ===== --}}
    <div id="typing"
        class="fixed inset-0 z-[100] hidden flex-col items-center justify-center bg-base-100/75 px-6 font-mono text-base-content opacity-0 backdrop-blur-xl transition-opacity duration-300"
        role="dialog" aria-modal="true" aria-label="Typing test">
        <div class="w-full max-w-2xl">
            <div class="mb-6 h-0.5 w-full overflow-hidden rounded-full bg-base-content/10">
                <div id="t-bar" class="h-full w-0 bg-base-content transition-[width] duration-150"></div>
            </div>

            <p id="t-text"
                class="select-none whitespace-pre-wrap break-words text-xl leading-9 lg:text-2xl lg:leading-10"
                aria-live="off"></p>

            <dl class="mt-8 flex items-baseline gap-8 text-sm">
                <div class="flex items-baseline gap-1.5">
                    <dt class="text-base-content/50">wpm</dt>
                    <dd id="t-wpm" class="text-lg font-medium tabular-nums">0</dd>
                </div>
                <div class="flex items-baseline gap-1.5">
                    <dt class="text-base-content/50">accuracy</dt>
                    <dd id="t-acc" class="text-lg font-medium tabular-nums">100%</dd>
                </div>
                <div class="flex items-baseline gap-1.5">
                    <dt class="text-base-content/50">time</dt>
                    <dd id="t-time" class="text-lg font-medium tabular-nums">0.0s</dd>
                </div>
            </dl>

            <p class="mt-6 text-xs text-base-content/50">
                <span id="t-msg">start typing to begin</span>
                &nbsp;·&nbsp; <kbd class="kbd kbd-xs">Tab</kbd> restart &nbsp; <kbd class="kbd kbd-xs">Esc</kbd> close
            </p>
        </div>
    </div>

    <script>
        const $ = (id) => document.getElementById(id);
        const sleep = (ms) => new Promise((r) => setTimeout(r, ms));
        const isDesktop = () => window.matchMedia('(min-width: 1024px)').matches;

        // ---------- KEYBOARD SOUND ENGINE ----------
        const KeyboardSound = (() => {
            let ctx = null;
            let enabled = false;
            try { enabled = localStorage.getItem('sound') === '1'; } catch (e) { }

            const initCtx = () => {
                if (!ctx) {
                    ctx = new (window.AudioContext || window.webkitAudioContext)();
                }
                if (ctx.state === 'suspended') ctx.resume();
            };

            const play = (pitchMod = 0, isError = false) => {
                if (!enabled) return;
                initCtx();

                const t = ctx.currentTime;

                const osc = ctx.createOscillator();
                const gainOsc = ctx.createGain();
                osc.type = isError ? 'sawtooth' : 'triangle';
                const randomPitch = (Math.random() * 40) - 20;

                osc.frequency.setValueAtTime(isError ? 150 + pitchMod : 900 + randomPitch + pitchMod, t);
                osc.frequency.exponentialRampToValueAtTime(isError ? 80 + pitchMod : 300 + randomPitch, t + 0.02);

                gainOsc.gain.setValueAtTime(isError ? 0.2 : 0.15, t);
                gainOsc.gain.exponentialRampToValueAtTime(0.001, t + 0.04);

                osc.connect(gainOsc);
                gainOsc.connect(ctx.destination);
                osc.start(t);
                osc.stop(t + 0.05);

                if (!isError) {
                    const bufferSize = ctx.sampleRate * 0.03;
                    const buffer = ctx.createBuffer(1, bufferSize, ctx.sampleRate);
                    const data = buffer.getChannelData(0);
                    for (let i = 0; i < bufferSize; i++) {
                        data[i] = (Math.random() * 2 - 1) * Math.pow(1 - i / bufferSize, 3);
                    }

                    const noise = ctx.createBufferSource();
                    noise.buffer = buffer;

                    const filter = ctx.createBiquadFilter();
                    filter.type = 'lowpass';
                    filter.frequency.setValueAtTime(300 + pitchMod, t);

                    const gainNoise = ctx.createGain();
                    gainNoise.gain.setValueAtTime(0.25, t);
                    gainNoise.gain.exponentialRampToValueAtTime(0.001, t + 0.03);

                    noise.connect(filter);
                    filter.connect(gainNoise);
                    gainNoise.connect(ctx.destination);
                    noise.start(t);
                }
            };

            return {
                get enabled() { return enabled; },
                toggle() {
                    enabled = !enabled;
                    try { localStorage.setItem('sound', enabled ? '1' : '0'); } catch (e) { }
                    if (enabled) { initCtx(); play(0); }
                    return enabled;
                },
                tick(ok) { play(ok ? 0 : -100, !ok); },
                hover() { play(80, false); },
                click() { play(0, false); }
            };
        })();

        // ---------- Theme ----------
        const ThemeStore = (() => {
            let mode = 'dark';
            let slideTimer = null;
            const INDEX = { system: 0, light: 1, dark: 2 };

            const apply = (animate = false) => {
                const d = mode === 'dark' || (mode === 'system' && matchMedia('(prefers-color-scheme: dark)').matches);
                document.documentElement.setAttribute('data-theme', d ? 'night' : 'light');

                const pill = document.querySelector('.theme-pill');
                if (pill) {
                    if (animate) {
                        pill.classList.add('is-sliding');
                        clearTimeout(slideTimer);
                        slideTimer = setTimeout(() => pill.classList.remove('is-sliding'), 280);
                    }
                    pill.style.setProperty('--theme-idx', INDEX[mode] ?? 2);
                }

                document.querySelectorAll('[data-theme-btn]').forEach(b => {
                    const on = b.dataset.themeBtn === mode;
                    b.classList.toggle('text-base-content', on);
                    b.classList.toggle('text-base-content/50', !on);
                    b.setAttribute('aria-pressed', on);
                });
            };
            return {
                init() {
                    try { mode = localStorage.getItem('theme') || 'dark'; } catch (e) { }
                    matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => apply(false));
                    apply(false);
                },
                set(next, ev) {
                    const run = () => { mode = next; try { localStorage.setItem('theme', next); } catch (e) { } apply(true); };
                    if (!document.startViewTransition || matchMedia('(prefers-reduced-motion: reduce)').matches) return run();
                    if (ev) {
                        document.documentElement.style.setProperty('--wipe-x', ev.clientX + 'px');
                        document.documentElement.style.setProperty('--wipe-y', ev.clientY + 'px');
                    }
                    document.startViewTransition(run);
                },
            };
        })();
        ThemeStore.init();
        document.querySelectorAll('[data-theme-btn]').forEach(b => b.addEventListener('click', e => ThemeStore.set(b.dataset.themeBtn, e)));

        // ---------- Close mobile drawer on nav click or resize to desktop ----------
        const drawerToggle = $('nav-drawer');
        const closeDrawer = () => { if (drawerToggle) drawerToggle.checked = false; };
        document.querySelectorAll('aside a').forEach(a => a.addEventListener('click', closeDrawer));
        window.addEventListener('resize', () => { if (isDesktop()) closeDrawer(); });

        // ---------- Global Hover & Click Sounds ----------
        (() => {
            const interactiveSelector = 'a, button, .nav-item, .theme-btn, [role="button"]';
            const elements = document.querySelectorAll(interactiveSelector);

            elements.forEach(el => {
                el.addEventListener('mouseenter', () => KeyboardSound.hover());
                el.addEventListener('mousedown', () => KeyboardSound.click());
            });
        })();

        // ---------- Sound Button ----------
        (() => {
            const btn = $('sound-btn');
            if (!btn) return;

            const sync = () => {
                const on = KeyboardSound.enabled;
                btn.setAttribute('aria-pressed', on);
                btn.querySelector('[data-on]').classList.toggle('hidden', !on);
                btn.querySelector('[data-off]').classList.toggle('hidden', on);
                btn.classList.toggle('text-base-content', on);
            };
            sync();

            btn.addEventListener('click', () => {
                KeyboardSound.toggle();
                sync();
            });
        })();

        // ---------- Overlay helpers (isang overlay lang ang bukas) ----------
        const overlays = {};
        function makeOverlay(name, el, flexClass, onClose) {
            let isOpen = false;
            const o = {
                get isOpen() { return isOpen; },
                open() {
                    Object.values(overlays).forEach(x => x !== o && x.close());
                    isOpen = true; closeDrawer();
                    el.classList.remove('hidden'); el.classList.add(flexClass);
                    requestAnimationFrame(() => requestAnimationFrame(() => el.classList.remove('opacity-0')));
                },
                close() {
                    if (!isOpen) return;
                    isOpen = false; onClose && onClose();
                    el.classList.add('opacity-0');
                    setTimeout(() => { if (!isOpen) { el.classList.remove(flexClass); el.classList.add('hidden'); } }, 300);
                },
            };
            overlays[name] = o;
            el.addEventListener('click', e => { if (e.target === el) o.close(); });
            el.querySelectorAll('[data-close-overlay]').forEach(btn => btn.addEventListener('click', () => o.close()));
            return o;
        }

        // ---------- Viewers ----------
        (() => {
            const box = $('v-avatars'), countEl = $('v-count'), noun = $('v-noun');
            let id = '';
            try { id = localStorage.getItem('vid') || (crypto.randomUUID ? crypto.randomUUID() : String(Math.random()).slice(2)); localStorage.setItem('vid', id); } catch (e) { id = String(Math.random()).slice(2); }

            const render = (count, avatars) => {
                countEl.textContent = count; noun.textContent = count === 1 ? 'person' : 'people';
                box.replaceChildren(...avatars.map(a => {
                    const s = document.createElement('span');
                    s.className = 'flex h-6 w-6 items-center justify-center rounded-full border-2 border-base-100 text-[10px] font-semibold text-white';
                    s.style.background = a.color; s.textContent = a.initials;
                    return s;
                }));
            };
            render(1, [{ initials: id.slice(0, 2).toUpperCase(), color: '#22c55e' }]);

            const beat = async () => {
                try {
                    const res = await fetch('/presence', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                        body: JSON.stringify({ id }),
                    });
                    if (!res.ok) return;
                    const j = await res.json();
                    render(j.count, j.avatars);
                } catch (e) { }
            };
            beat(); setInterval(beat, 30000);
        })();

        // ---------- Alt+K: Ask anything ----------
        (() => {
            const el = $('ask'), form = $('ask-form'), input = $('ask-input'), wait = $('ask-wait'), asked = $('ask-asked'), status = $('ask-status'), line = $('ask-line'), end = $('ask-end');
            let run = 0;

            const INTRO = ['before i answer', 'here is what your browser already shared the moment you opened this site'];
            const OUTRO = ['your browser shares it with every website you open, automatically', 'so be mindful of what you click, and who you trust online', 'as for your question'];
            const CLOSING = "i won't answer that one. try searching for it :)";

            const step = (s) => {
                form.classList.toggle('hidden', s !== 'input');
                wait.classList.toggle('hidden', s !== 'wait');
                line.classList.toggle('hidden', s !== 'story');
                end.classList.add('hidden');
            };
            const o = makeOverlay('ask', el, 'flex', () => { run++; });
            el.addEventListener('click', (e) => {
                if (e.target.closest('[data-close-overlay]')) return;
                if (form.classList.contains('hidden')) o.close();
            });
            const open = () => { o.open(); run++; step('input'); input.value = ''; line.classList.add('opacity-0'); setTimeout(() => input.focus(), 50); };

            const osName = () => {
                const ua = navigator.userAgent.toLowerCase();
                const p = (navigator.userAgentData?.platform || navigator.platform || ua).toLowerCase();
                if (ua.includes('android')) return 'android';
                if (/iphone|ipad/.test(ua)) return 'ios';
                if (p.includes('win')) return 'windows';
                if (p.includes('mac')) return 'mac';
                if (p.includes('linux')) return 'linux';
                return 'unknown';
            };
            const browserInfo = () => {
                const ua = navigator.userAgent;
                const m = ua.match(/(Edg|OPR|Firefox|FxiOS|CriOS|Chrome)\/(\d+)/);
                const names = { Edg: 'edge', OPR: 'opera', Firefox: 'firefox', FxiOS: 'firefox', CriOS: 'chrome', Chrome: 'chrome' };
                if (m) return `${names[m[1]]} ${m[2]}`;
                const s = ua.match(/Version\/(\d+).*Safari/);
                return s ? `safari ${s[1]}` : 'an unknown browser';
            };
            const lookupGeo = async () => {
                try { const j = await (await fetch('https://ipwho.is/')).json(); if (j.success) return { ip: j.ip, city: j.city, region: j.region, country: j.country, isp: j.connection && j.connection.isp, lat: j.latitude, lon: j.longitude }; } catch (e) { }
                try { const j = await (await fetch('https://ipapi.co/json/')).json(); if (j.ip) return { ip: j.ip, city: j.city, region: j.region, country: j.country_name, isp: j.org, lat: j.latitude, lon: j.longitude }; } catch (e) { }
                return null;
            };
            const collectFacts = async () => {
                const facts = [], g = await lookupGeo();
                if (g) {
                    const place = [g.city, g.region, g.country].filter(Boolean).join(', ');
                    if (place) facts.push(`you are currently in ${place.toLowerCase()}`);
                    if (g.ip) facts.push(`your public ip address is ${g.ip}`);
                    if (g.isp) facts.push(`you are connected through ${String(g.isp).toLowerCase()}`);
                    if (g.lat != null) facts.push(`your approximate coordinates are around ${Number(g.lat).toFixed(2)}, ${Number(g.lon).toFixed(2)}`);
                }
                const cores = navigator.hardwareConcurrency, mem = navigator.deviceMemory;
                let device = `you are on a ${osName()} device`;
                if (cores && mem) device += ` with ${cores} processor cores and ${mem}gb of memory`;
                else if (cores) device += ` with ${cores} processor cores`;
                facts.push(device);
                facts.push(`you are browsing with ${browserInfo()} set to ${(navigator.language || 'en').toLowerCase()}`);
                const tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
                const time = new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }).toLowerCase();
                facts.push(`your timezone is ${tz.toLowerCase()} and it is around ${time} where you are`);
                let from = '';
                try { from = new URL(document.referrer).hostname.replace(/^www\./, ''); } catch (e) { }
                facts.push(from ? `you arrived here from ${from}` : 'you arrived here directly');
                return facts;
            };

            const say = async (text, ms, id) => {
                line.textContent = text; line.classList.remove('opacity-0');
                await sleep(ms); if (id !== run) throw 0;
                line.classList.add('opacity-0');
                await sleep(500); if (id !== run) throw 0;
            };

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const q = input.value.trim(); if (!q) return;
                const id = ++run;
                asked.textContent = q; status.textContent = 'thinking...'; step('wait');
                setTimeout(() => { if (id === run) status.textContent = 'analyzing...'; }, 900);
                try {
                    const [facts] = await Promise.all([collectFacts(), sleep(1800)]);
                    if (id !== run) return;
                    step('story');
                    for (const t of [...INTRO, ...facts, ...OUTRO]) await say(t, 2600, id);
                    line.textContent = CLOSING; line.classList.remove('opacity-0');
                    end.classList.remove('hidden');
                } catch (err) { }
            });

            document.querySelectorAll('[data-open-ask]').forEach(b => b.addEventListener('click', open));
            window.__openAsk = open; window.__askOverlay = o;
        })();

        // ---------- Alt+J: Typing test (Desktop/Laptop only) ----------
        (() => {
            const el = $('typing'), text = $('t-text'), bar = $('t-bar'), msg = $('t-msg');
            const out = { wpm: $('t-wpm'), acc: $('t-acc'), time: $('t-time') };
            const WORDS = 'time year people way day man thing woman life child world school state family student group country problem hand part place case week company system program question work government number night point home water room mother area money story fact month lot right study book eye job word business issue side kind head house service friend father power hour game line end member law car city community name team minute idea kid body information back parent face others level office door health person art war history party result change morning reason research girl guy moment air teacher force education'.split(' ');
            let target = '', typed = '', keys = 0, hits = 0, t0 = 0, timer = null, done = false, spans = [];

            const o = makeOverlay('typing', el, 'flex', () => clearInterval(timer));
            const secs = () => (t0 ? (performance.now() - t0) / 1000 : 0);

            const paint = () => {
                spans.forEach((s, i) => {
                    const t = typed[i];
                    let c = 'text-base-content/30';
                    if (t !== undefined) c = t === target[i] ? 'text-base-content' : (target[i] === ' ' ? 'bg-error/30 text-error' : 'text-error');
                    if (i === typed.length && !done) c += ' border-l-2 border-base-content -ml-[2px]';
                    s.className = c;
                });
                const sec = secs();
                out.wpm.textContent = sec > 0.5 ? Math.round(hits / 5 / (sec / 60)) : 0;
                out.acc.textContent = (keys ? Math.round((hits / keys) * 100) : 100) + '%';
                out.time.textContent = sec.toFixed(1) + 's';
                bar.style.width = (target.length ? Math.round((typed.length / target.length) * 100) : 0) + '%';
            };

            const reset = () => {
                clearInterval(timer);
                target = Array.from({ length: 25 }, () => WORDS[Math.floor(Math.random() * WORDS.length)]).join(' ');
                typed = ''; keys = 0; hits = 0; t0 = 0; done = false;
                text.replaceChildren(...target.split('').map(ch => { const s = document.createElement('span'); s.textContent = ch; return s; }));
                spans = [...text.children];
                msg.textContent = 'start typing to begin'; msg.classList.remove('text-base-content');
                paint();
            };
            const open = () => {
                if (!isDesktop()) return;
                reset();
                o.open();
            };

            window.addEventListener('resize', () => {
                if (!isDesktop() && o.isOpen) o.close();
            });

            const onKey = (e) => {
                if (!o.isOpen) return;
                if (e.key === 'Tab') { e.preventDefault(); reset(); return; }
                if (done || e.ctrlKey || e.metaKey || e.altKey) return;
                if (e.key === 'Backspace') { e.preventDefault(); typed = typed.slice(0, -1); paint(); return; }
                if (e.key.length !== 1) return;
                e.preventDefault();
                if (!t0) { t0 = performance.now(); timer = setInterval(paint, 100); }
                const ok = e.key === target[typed.length];
                keys++; if (ok) hits++;
                typed += e.key;

                KeyboardSound.tick(ok);

                if (typed.length === target.length) {
                    clearInterval(timer); done = true;
                    msg.textContent = 'done. nice run.'; msg.classList.add('text-base-content');
                }
                paint();
            };
            document.addEventListener('keydown', onKey);
            document.querySelectorAll('[data-open-typing]').forEach(b => b.addEventListener('click', open));
            window.__openTyping = open; window.__typingOverlay = o;
        })();

        // ---------- Global shortcuts: Alt+K, Alt+J, Esc ----------
        document.addEventListener('keydown', (e) => {
            if ((e.metaKey || e.ctrlKey || e.altKey) && e.code === 'KeyK') { e.preventDefault(); window.__openAsk(); return; }
            if ((e.metaKey || e.ctrlKey || e.altKey) && e.code === 'KeyJ') {
                if (!isDesktop()) return;
                e.preventDefault();
                window.__openTyping();
                return;
            }
            if (e.key === 'Escape') Object.values(overlays).forEach(o => o.close());
        });
    </script>
    @stack('scripts')
</body>

</html>