{{-- ===== Ask anything (Alt+K): fullscreen overlay + "what your browser already shared" reveal ===== --}}
<div x-data="askOverlay()" @open-ask.window="show()" @keydown.window.alt.k.prevent="show()" @keydown.window.escape="close()"
     x-show="open" x-cloak x-transition.opacity.duration.300ms
     class="ask-overlay fixed inset-0 z-[100] flex items-center bg-base-100/75 px-[6vw] font-mono backdrop-blur-xl"
     role="dialog" aria-modal="true" aria-label="Ask anything" @click.self="close()">

    <div class="ask-box w-full">

        {{-- 1. Input --}}
        <form x-show="step === 'input'" @submit.prevent="submit()" class="space-y-3">
            <h2 class="ask-title font-sans font-medium text-base-content">what do you want to ask?</h2>
            <input x-ref="input" x-model="q" maxlength="200" autocomplete="off" spellcheck="false"
                   class="ask-input w-full bg-transparent text-base-content/70 caret-base-content outline-none" aria-label="Your question">
            <p class="ask-hint text-base-content/40">press enter to send &middot; esc to close</p>
        </form>

        {{-- 2. Analyzing --}}
        <div x-show="step === 'analyzing'" class="space-y-4">
            <p class="ask-asked w-fit max-w-full break-words rounded-md border border-base-content/15 bg-base-200/60 px-2.5 py-1.5 text-base-content" x-text="asked"></p>
            <p class="ask-status flex items-center gap-2 text-base-content/50">
                <svg class="ask-spin h-3.5 w-3.5 animate-spin" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3a9 9 0 1 0 9 9" stroke-linecap="round"/></svg>
                <span class="animate-pulse" x-text="status + '...'"></span>
            </p>
        </div>

        {{-- 3. One line at a time --}}
        <p x-show="step === 'story' && line" x-transition.opacity.duration.400ms
           class="ask-line max-w-sm font-sans leading-snug text-base-content" x-text="line"></p>
    </div>
</div>

<style>
    /* ===== Ask overlay: fluid typography (adoptable sa lahat ng device) ===== */
    .ask-overlay {
        /* Vertical centering + safe padding sa notch devices */
        padding-block: max(1rem, env(safe-area-inset-top)) max(1rem, env(safe-area-inset-bottom));
    }

    .ask-box {
        /* Lapad ng content: maliit sa mobile, sakto sa tablet, hindi sumasagad sa ultrawide */
        max-width: clamp(18rem, 34vw + 8rem, 40rem);
        margin-inline: auto;
    }

    .ask-title {
        /* 1.35rem sa maliit na phone → 2.25rem sa desktop */
        font-size: clamp(1.35rem, 2.2vw + 0.9rem, 2.25rem);
        line-height: 1.2;
    }

    .ask-input {
        /* 0.9rem → 1.05rem */
        font-size: clamp(0.9rem, 0.6vw + 0.8rem, 1.05rem);
        line-height: 1.5;
    }

    .ask-hint {
        /* 0.7rem → 0.8rem */
        font-size: clamp(0.7rem, 0.35vw + 0.65rem, 0.8rem);
    }

    .ask-asked {
        /* 0.75rem → 0.875rem */
        font-size: clamp(0.75rem, 0.4vw + 0.68rem, 0.875rem);
        line-height: 1.4;
    }

    .ask-status {
        /* 0.8rem → 0.95rem */
        font-size: clamp(0.8rem, 0.45vw + 0.72rem, 0.95rem);
    }

    .ask-spin {
        /* Icon sabay sa status text */
        width: clamp(0.85rem, 0.5vw + 0.75rem, 1rem);
        height: clamp(0.85rem, 0.5vw + 0.75rem, 1rem);
    }

    .ask-line {
        /* Story line: pinakamalaki, 1.05rem → 1.35rem */
        font-size: clamp(1.05rem, 1vw + 0.85rem, 1.35rem);
        line-height: 1.4;
        max-width: clamp(16rem, 28vw + 10rem, 32rem);
    }

    /* Landscape phone / maliit na height: bawasan ang font para hindi mag-overflow */
    @media (max-height: 480px) {
        .ask-title { font-size: clamp(1.1rem, 2.2vh + 0.7rem, 1.5rem); }
        .ask-line  { font-size: clamp(0.95rem, 2vh + 0.6rem, 1.15rem); }
    }

    /* Prefers-reduced-motion: alisin ang blur transition kung kailangan */
    @media (prefers-reduced-motion: reduce) {
        .ask-overlay { transition: none !important; }
    }
</style>

<script>
const csrf = () => document.querySelector('meta[name="csrf-token"]')?.content ?? '';
const jpost = (url, data) => fetch(url, { method: 'POST', headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrf() }, body: JSON.stringify(data) });
const sleep = (ms) => new Promise((r) => setTimeout(r, ms));

// Browser name + version
function browserInfo() {
    const ua = navigator.userAgent;
    const m = ua.match(/(Edg|OPR|Firefox|FxiOS|CriOS|Chrome)\/(\d+)/) || ua.match(/Version\/(\d+).*Safari/);
    if (!m) return 'an unknown browser';
    const names = { Edg: 'edge', OPR: 'opera', Firefox: 'firefox', FxiOS: 'firefox', CriOS: 'chrome', Chrome: 'chrome' };
    return m.length === 3 ? `${names[m[1]]} ${m[2]}` : `safari ${m[1]}`;
}

// OS name
function osName() {
    const p = (navigator.userAgentData?.platform || navigator.platform || navigator.userAgent).toLowerCase();
    if (/android/.test(navigator.userAgent.toLowerCase())) return 'android';
    if (/iphone|ipad|ios/.test(p) || /iphone|ipad/.test(navigator.userAgent.toLowerCase())) return 'ios';
    if (p.includes('win')) return 'windows';
    if (p.includes('mac')) return 'mac';
    if (p.includes('linux')) return 'linux';
    return 'unknown';
}

// IP lookup na may fallback
async function lookupGeo() {
    try {
        const j = await (await fetch('https://ipwho.is/')).json();
        if (j.success) return { ip: j.ip, city: j.city, region: j.region, country: j.country, isp: j.connection?.isp, lat: j.latitude, lon: j.longitude };
    } catch (e) {}
    try {
        const j = await (await fetch('https://ipapi.co/json/')).json();
        if (j.ip) return { ip: j.ip, city: j.city, region: j.region, country: j.country_name, isp: j.org, lat: j.latitude, lon: j.longitude };
    } catch (e) {}
    return null;
}

// Mga ibinibigay na ng browser/network sa bawat website
async function collectFacts() {
    const facts = [];
    const g = await lookupGeo();

    if (g) {
        const place = [g.city, g.region, g.country].filter(Boolean).join(', ');
        if (place) facts.push(`you are currently in ${place.toLowerCase()}`);
        if (g.ip) facts.push(`your public ip address is ${g.ip}`);
        if (g.isp) facts.push(`you are connected through ${g.isp.toLowerCase()}`);
        if (g.lat != null) facts.push(`your approximate coordinates are around ${Number(g.lat).toFixed(2)}, ${Number(g.lon).toFixed(2)}`);
    }

    const cores = navigator.hardwareConcurrency;
    const mem = navigator.deviceMemory;
    let device = `you are on a ${osName()} device`;
    if (cores && mem) device += ` with ${cores} processor cores and ${mem}gb of memory`;
    else if (cores) device += ` with ${cores} processor cores`;
    facts.push(device);

    facts.push(`you are browsing with ${browserInfo()} set to ${(navigator.language || 'en').toLowerCase()}`);

    const tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
    const time = new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit' }).toLowerCase();
    facts.push(`your timezone is ${tz.toLowerCase()} and it is around ${time} where you are`);

    let from = '';
    try { from = new URL(document.referrer).hostname.replace(/^www\./, ''); } catch (e) {}
    facts.push(from ? `you arrived here from ${from}` : 'you arrived here directly');
    return facts;
}

document.addEventListener('alpine:init', () => {
    Alpine.data('presence', () => ({
        count: 1, avatars: [],
        start() {
            const id = localStorage.getItem('vid') || (crypto.randomUUID?.() ?? String(Math.random()).slice(2));
            localStorage.setItem('vid', id);
            const beat = async () => {
                try { const r = await (await jpost('/presence', { id })).json(); this.count = r.count; this.avatars = r.avatars; } catch (e) {}
            };
            beat(); setInterval(beat, 30000);
        },
    }));

    Alpine.data('askOverlay', () => ({
        open: false, step: 'input', q: '', asked: '', line: '', run: 0, status: 'thinking',

        intro: ['before i answer', 'here is what your browser already shared the moment you opened this site'],
        outro: ['your browser shares it with every website you open, automatically', 'so be mindful of what you click, and who you trust online', 'as for your question'],
        closing: "i won't answer that one. try searching for it :)",

        show() {
            this.run++; this.open = true; this.step = 'input'; this.q = ''; this.line = '';
            this.$nextTick(() => this.$refs.input.focus());
        },
        close() { this.run++; this.open = false; },

        async say(text, ms = 2600) {
            const id = this.run;
            this.line = text;
            await sleep(ms);
            if (id !== this.run) throw new Error('closed');
            this.line = '';
            await sleep(450);
            if (id !== this.run) throw new Error('closed');
        },

        async submit() {
            const question = this.q.trim(); if (!question) return;
            const id = ++this.run;
            this.asked = question; this.step = 'analyzing'; this.status = 'thinking';
            setTimeout(() => { if (id === this.run) this.status = 'analyzing'; }, 900);
            try {
                const [facts] = await Promise.all([collectFacts(), sleep(1800)]);
                if (id !== this.run) return;
                this.step = 'story';
                for (const l of [...this.intro, ...facts, ...this.outro]) await this.say(l);
                await this.say(this.closing, 3200);
                this.close();
            } catch (e) { /* closed mid-way */ }
        },
    }));
});
</script>