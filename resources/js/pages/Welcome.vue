<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';
import FloralDivider from '../components/FloralDivider.vue';
import BotanicalFlower from '../components/BotanicalFlower.vue';

const sections = [
    { id: 'dagen', label: 'Dagen' },
    { id: 'platser', label: 'Platser' },
    { id: 'picknick', label: 'Picknick' },
    { id: 'gavor', label: 'Inga gåvor' },
    { id: 'kladsel', label: 'Klädsel' },
];

const locations = [
    {
        label: 'Vigsel',
        name: 'Erlandstorp',
        time: 'Kl. 14:00',
        parking:
            'Erlandstorp är en privat hästgård. Parkera längs vägen, framför garaget eller på stallplan.',
        animals:
            'På Erlandstorp finns hästar, får, hundar och katter.',
        mapUrl: 'https://maps.app.goo.gl/AFJTfsf56wWRnJts6',
        embedUrl:
            'https://maps.google.com/maps?q=58.9767663,16.5945245&hl=sv&z=15&t=h&output=embed',
    },
    {
        label: 'Picknick',
        name: 'Gripensnäs 3',
        time: 'Drop in från kl. 15:30',
        parking:
            'Hemma hos oss. Parkera på grusplanen innan och framför ladugården, eller längs vägen fram till herrgården — det går bra i alla väder. Gräsmattan framför huset går att använda endast vid torrt väder.',
        animals: 'På Gripensnäs finns våra katter Sixten och Wilma. Om ni har tur kanske ni kan få se en ko eller två eller en fasan.',
        mapUrl: 'https://maps.app.goo.gl/858kHGPnCnJdh4HN9',
        embedUrl:
            'https://maps.google.com/maps?q=58.9399569,16.5859769&hl=sv&z=15&t=h&output=embed',
    },
];

const activeSection = ref('');
const navVisible = ref(false);
const mobileMenuOpen = ref(false);
const scrollY = ref(0);
const prefersReducedMotion = ref(false);

let sectionObserver: IntersectionObserver | undefined;

function blobParallax(scrollFactor: number, horizontalFactor?: number): string {
    if (prefersReducedMotion.value) {
        return '';
    }

    const y = scrollY.value * scrollFactor;
    const x =
        window.innerWidth >= 768
            ? scrollY.value * (horizontalFactor ?? scrollFactor * 0.3)
            : 0;

    return `translate3d(${x}px, ${y}px, 0)`;
}

function handleScroll(): void {
    scrollY.value = window.scrollY;
    navVisible.value = window.scrollY > 120;

    const scrollPosition = window.scrollY + window.innerHeight / 3;
    let current = '';

    for (const section of sections) {
        const element = document.getElementById(section.id);
        if (element && element.offsetTop <= scrollPosition) {
            current = section.id;
        }
    }

    activeSection.value = current;
}

function scrollToSection(id: string): void {
    mobileMenuOpen.value = false;
    document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });
}

onMounted(() => {
    prefersReducedMotion.value = window.matchMedia(
        '(prefers-reduced-motion: reduce)',
    ).matches;

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();

    sectionObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        },
        { threshold: 0.12, rootMargin: '0px 0px -48px 0px' },
    );

    document
        .querySelectorAll('.reveal-section')
        .forEach((element) => sectionObserver?.observe(element));
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    sectionObserver?.disconnect();
});
</script>

<template>
    <Head title="Amanda & Andreas · 1 augusti 2026">
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&display=swap"
            rel="stylesheet"
        />
    </Head>

    <div class="page-root relative min-h-screen overflow-x-hidden scroll-smooth bg-[#FBF5F7] text-[#3D2C35]">
        <div
            class="ambient-bg pointer-events-none fixed inset-0 z-0 overflow-hidden"
            aria-hidden="true"
        >
            <div class="ambient-gradient ambient-gradient-shift absolute inset-0" />

            <div
                class="absolute inset-0"
                :style="{ transform: blobParallax(0.12) }"
            >
                <div
                    class="ambient-drift glow-pulse absolute -top-32 -right-20 h-[28rem] w-[28rem] rounded-full bg-[#E8C4D0]/55 blur-3xl"
                />
            </div>

            <div
                class="absolute inset-0"
                :style="{ transform: blobParallax(-0.08, -0.04) }"
            >
                <div
                    class="ambient-drift-reverse glow-pulse absolute top-[35%] -left-32 h-[26rem] w-[26rem] rounded-full bg-[#DDBDD0]/50 blur-3xl"
                    style="animation-delay: 3s"
                />
            </div>

            <div
                class="absolute inset-0"
                :style="{ transform: blobParallax(0.06, 0.05) }"
            >
                <div
                    class="ambient-drift glow-pulse absolute top-[62%] -right-24 h-[24rem] w-[24rem] rounded-full bg-[#C98FA0]/35 blur-3xl"
                    style="animation-delay: 6s"
                />
            </div>

            <div
                class="absolute inset-0"
                :style="{ transform: blobParallax(-0.05) }"
            >
                <div
                    class="ambient-drift-reverse absolute top-[82%] left-[15%] h-80 w-80 rounded-full bg-[#F5EBEF]/90 blur-3xl"
                    style="animation-delay: 1.5s"
                />
            </div>

            <div
                class="absolute inset-0"
                :style="{ transform: blobParallax(0.04, -0.03) }"
            >
                <div
                    class="ambient-drift absolute top-[18%] left-[55%] h-72 w-72 rounded-full bg-[#E8C4D0]/30 blur-3xl"
                    style="animation-delay: 4s"
                />
            </div>
        </div>

        <nav
            class="fixed inset-x-0 top-0 z-50 transition-all duration-500"
            :class="
                navVisible || mobileMenuOpen
                    ? 'border-b border-[#3D2C35]/8 bg-[#FBF5F7]/95 shadow-sm backdrop-blur-md'
                    : 'bg-transparent'
            "
        >
            <div
                class="mx-auto flex max-w-3xl items-center justify-between px-6 py-4"
            >
                <button
                    type="button"
                    class="font-serif text-lg tracking-wide text-[#3D2C35] transition-opacity hover:opacity-70"
                    @click="scrollToSection('hem')"
                >
                    A.N + A.S = A.N.S
                </button>

                <div class="hidden items-center gap-6 md:flex">
                    <button
                        v-for="section in sections"
                        :key="section.id"
                        type="button"
                        class="text-sm tracking-wide uppercase transition-colors"
                        :class="
                            activeSection === section.id
                                ? 'text-accent-rose'
                                : 'text-[#3D2C35]/55 hover:text-[#3D2C35]'
                        "
                        @click="scrollToSection(section.id)"
                    >
                        {{ section.label }}
                    </button>
                </div>

                <button
                    type="button"
                    class="inline-flex size-10 items-center justify-center rounded-md text-[#3D2C35] transition-colors hover:bg-[#3D2C35]/5 md:hidden"
                    :aria-expanded="mobileMenuOpen"
                    aria-controls="mobile-nav"
                    aria-label="Meny"
                    @click="mobileMenuOpen = !mobileMenuOpen"
                >
                    <svg
                        v-if="!mobileMenuOpen"
                        class="size-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            d="M4 7h16M4 12h16M4 17h16"
                        />
                    </svg>
                    <svg
                        v-else
                        class="size-5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            d="M6 6l12 12M18 6L6 18"
                        />
                    </svg>
                </button>
            </div>

            <div
                v-show="mobileMenuOpen"
                id="mobile-nav"
                class="border-t border-[#3D2C35]/8 px-6 py-4 md:hidden"
            >
                <div class="flex flex-col gap-1">
                    <button
                        v-for="section in sections"
                        :key="section.id"
                        type="button"
                        class="rounded-md px-3 py-2.5 text-left text-sm tracking-wide uppercase transition-colors"
                        :class="
                            activeSection === section.id
                                ? 'bg-accent-rose/10 text-accent-rose'
                                : 'text-[#3D2C35]/70 hover:bg-[#3D2C35]/5 hover:text-[#3D2C35]'
                        "
                        @click="scrollToSection(section.id)"
                    >
                        {{ section.label }}
                    </button>
                </div>
            </div>
        </nav>

        <header
            id="hem"
            class="relative z-10 flex min-h-screen flex-col items-center justify-center overflow-x-hidden px-6 pt-20 pb-16 text-center"
        >
            <BotanicalFlower
                variant="flower-1"
                :scale="1.15"
                :delay="0"
                :duration="8"
                class="pointer-events-none absolute top-28 -left-2 sm:left-8"
            />
            <BotanicalFlower
                variant="flower-2"
                :scale="1.05"
                :delay="1.5"
                :duration="9"
                class="pointer-events-none absolute top-36 -right-2 sm:right-8"
                flip
            />
            <BotanicalFlower
                variant="flower-3"
                :scale="0.95"
                :delay="0.8"
                :duration="10"
                class="pointer-events-none absolute bottom-24 left-6 hidden md:block"
            />
            <BotanicalFlower
                variant="flower-4"
                :scale="1.1"
                :delay="2.2"
                :duration="8.5"
                class="pointer-events-none absolute right-10 bottom-20 hidden md:block"
                flip
            />

            <div class="relative max-w-2xl">
                <p
                    class="hero-enter mb-6 text-sm tracking-[0.35em] text-accent-rose uppercase"
                >
                    Vi gifter oss
                </p>

                <h1
                    class="hero-enter hero-enter-delay-1 font-serif text-5xl leading-tight font-light tracking-wide sm:text-7xl"
                >
                    Amanda
                    <span
                        class="mx-3 block text-3xl text-[#C98FA0] italic sm:mx-0 sm:inline sm:text-4xl"
                        >&</span
                    >
                    Andreas
                </h1>

                <FloralDivider class="hero-enter hero-enter-delay-2 mx-auto max-w-xs" />

                <p
                    class="hero-enter hero-enter-delay-2 mt-6 font-serif text-2xl text-[#3D2C35]/90 sm:text-3xl"
                >
                    1 augusti 2026
                </p>

                <blockquote
                    class="hero-enter hero-enter-delay-4 mt-6 border-l-2 border-[#C98FA0]/40 pl-6 text-left text-xl leading-relaxed text-[#3D2C35]/80"
                >
                    Välkommen att vara med den 1 augusti klockan 14 när vi gifter oss under ekarna på
                    Vadsbro Erlandstorp. Efter vigseln är ni välkomna hem till oss på
                    picknick i trädgården — drop in från 15:30. Vi bjuder på
                    välkomstdrink, enklare tilltugg, tårta och såklart
                    finkaffe. Välkomna att dela dagen med oss.
                </blockquote>
            </div>

            <button
                type="button"
                class="hero-enter hero-enter-delay-5 relative mt-16 flex flex-col items-center gap-2 text-sm tracking-widest text-accent-rose uppercase transition-colors hover:text-accent-rose-hover"
                @click="scrollToSection('dagen')"
            >
                <span>Läs mer</span>
                <svg
                    class="h-5 w-5 animate-bounce"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="1.5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 9l-7 7-7-7"
                    />
                </svg>
            </button>
        </header>

        <main class="relative z-10 mx-auto max-w-3xl px-6 pb-24 text-xl leading-relaxed">
            <section id="dagen" class="reveal-section scroll-mt-20 py-16">
                <SectionHeading subtitle="Schema" title="Dagen" />

                <div class="mt-10 space-y-0">
                    <TimelineItem
                        badge="14"
                        time="14:00"
                        title="Vigsel"
                        location="Vadsbro Erlandstorp"
                        description="Vi gifter oss under ekarna nedanför bostadshuset. Hjärtligt välkommen att vara med på vigseln."
                        :show-line="true"
                    />
                    <TimelineItem
                        badge="15"
                        time="15:30"
                        title="Picknick"
                        location="Gripensnäs 3"
                        description="Drop in hem till oss i trädgården. Ta gärna med det ni vill dricka och äta; vi bjuder på välkomstdrink, tilltugg, tårta och finkaffe."
                    />
                </div>
            </section>

            <FloralDivider />

            <section id="platser" class="reveal-section scroll-mt-20 py-16">
                <SectionHeading subtitle="Hitta hit" title="Platser" />

                <div
                    class="card-hover mt-8 overflow-hidden rounded-xl border border-[#C98FA0]/25 bg-linear-to-br from-white/80 via-[#F5EBEF]/90 to-[#FBF5F7] shadow-sm backdrop-blur-sm"
                >
                    <div class="px-6 py-7 sm:px-8">
                        <p
                            class="text-center text-sm tracking-[0.3em] text-accent-rose uppercase"
                        >
                            Mellan vigseln och picknicken
                        </p>

                        <div
                            class="mt-6 flex flex-col items-stretch gap-5 sm:flex-row sm:items-center sm:gap-4"
                        >
                            <div class="text-center sm:flex-1">
                                <p
                                    class="text-sm tracking-[0.3em] text-accent-rose uppercase"
                                >
                                    Vigsel
                                </p>
                                <p class="mt-1 font-serif text-xl text-[#3D2C35]">
                                    Vadsbro Erlandstorp
                                </p>
                            </div>

                            <div
                                class="flex items-center justify-center gap-3 sm:flex-1"
                            >
                                <div
                                    class="hidden h-px flex-1 bg-linear-to-r from-transparent to-[#C98FA0]/40 sm:block"
                                />
                                <div
                                    class="flex flex-col items-center gap-1 rounded-full border border-[#C98FA0]/30 bg-white/70 px-5 py-3 shadow-sm"
                                >
                                    <svg
                                        class="h-5 w-5 text-accent-rose"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.5"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"
                                        />
                                    </svg>
                                    <p
                                        class="font-serif text-2xl leading-none text-[#3D2C35]"
                                    >
                                        &lt; 10 min
                                    </p>
                                    <p class="text-xs tracking-[0.3em] text-accent-rose uppercase">
                                        Med bil
                                    </p>
                                </div>
                                <div
                                    class="hidden h-px flex-1 bg-linear-to-l from-transparent to-[#C98FA0]/40 sm:block"
                                />
                            </div>

                            <div class="text-center sm:flex-1">
                                <p
                                    class="text-sm tracking-[0.3em] text-accent-rose uppercase"
                                >
                                    Picknick
                                </p>
                                <p class="mt-1 font-serif text-xl text-[#3D2C35]">
                                    Gripensnäs 3
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-start gap-4 border-t border-[#C98FA0]/20 bg-[#F5EBEF]/50 px-6 py-5 sm:px-8"
                    >
                        <div
                            class="mt-0.5 flex h-9 w-9 shrink-0 items-center justify-center rounded-full border border-[#C98FA0]/25 bg-white/80 text-accent-rose"
                        >
                            <svg
                                class="h-4.5 w-4.5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.5"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"
                                />
                            </svg>
                        </div>
                        <div>
                            <p class="font-medium text-[#3D2C35]">
                                Samåk gärna om ni kan
                            </p>
                            <p
                                class="mt-1 text-[#3D2C35]/75"
                            >
                                Det är begränsat med parkeringsplatser på både
                                Erlandstorp och Gripensnäs — vi uppskattar om så
                                många som möjligt kan samåka.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-10 space-y-12">
                    <article
                        v-for="location in locations"
                        :key="location.name"
                        class="card-hover overflow-hidden rounded-xl border border-[#3D2C35]/8 bg-white/70 shadow-sm backdrop-blur-sm"
                    >
                        <div class="p-6">
                            <p
                                class="text-sm tracking-[0.3em] text-accent-rose uppercase"
                            >
                                {{ location.label }}
                            </p>
                            <h3 class="mt-1 font-serif text-3xl">
                                {{ location.name }}
                            </h3>
                            <p class="mt-1 text-[#3D2C35]/65">
                                {{ location.time }}
                            </p>
                            <p
                                class="mt-4 text-[#3D2C35]/75"
                            >
                                {{ location.parking }}
                            </p>
                            <p
                                v-if="location.animals"
                                class="mt-3 text-[#3D2C35]/75"
                            >
                                {{ location.animals }}
                            </p>
                            <a
                                :href="location.mapUrl"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-4 inline-flex items-center gap-1.5 font-medium text-accent-rose transition-colors hover:text-accent-rose-hover"
                            >
                                Öppna i Google Maps
                                <svg
                                    class="h-3.5 w-3.5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                                    />
                                </svg>
                            </a>
                        </div>
                        <div class="aspect-[16/10] w-full border-t border-[#3D2C35]/8">
                            <iframe
                                :src="location.embedUrl"
                                :title="`Karta till ${location.name}`"
                                class="h-full w-full"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                allowfullscreen
                            />
                        </div>
                    </article>
                </div>
            </section>

            <FloralDivider />

            <section id="picknick" class="reveal-section scroll-mt-20 py-16">
                <SectionHeading subtitle="I trädgården" title="Picknick" />

                <div
                    class="mt-10 space-y-5 text-[#3D2C35]/85"
                >
                    <p>
                        Utöver det vi bjuder på tar ni gärna med det ni själva
                        vill dricka och äta. Grillar finns på plats, och ni
                        får använda köket om ni vill.
                    </p>
                    <p>
                        Stolar blir det begränsat med, men trädgården är stor —
                        ta gärna med filt eller egna sittmöbler om ni vill sitta
                        skönt.
                    </p>
                    <p
                        class="flex items-center gap-3 rounded-lg border border-[#C98FA0]/25 bg-[#F5EBEF]/80 px-5 py-4 text-[#3D2C35]/75 backdrop-blur-sm"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="size-6"><path d="M320 32C337.7 32 352 46.3 352 64L352 66C478.3 81.7 576 189.5 576 320C576 323.8 575.9 327.5 575.8 331.3C575.5 338.2 570.8 344.1 564.1 346C557.4 347.9 550.3 345.3 546.5 339.5C532.1 318.1 507.7 304 480 304C450.7 304 425.1 319.7 411.1 343.3C408.4 347.9 403.5 350.9 398.1 351.1C392.7 351.3 387.6 348.9 384.4 344.6C369.8 324.8 346.4 312 319.9 312C293.4 312 270 324.8 255.4 344.6C252.2 348.9 247.1 351.4 241.7 351.1C236.3 350.8 231.5 347.9 228.7 343.3C214.7 319.7 189.1 304 159.8 304C132.1 304 107.7 318.1 93.3 339.5C89.4 345.2 82.3 347.9 75.7 346C69.1 344.1 64.5 338.2 64.2 331.3C64.1 327.5 64 323.8 64 320C64 189.5 161.7 81.7 288 66L288 64C288 46.3 302.3 32 320 32zM352 392L352 494.6C352 539.6 315.5 576 270.6 576C239.8 576 211.6 558.6 197.8 531L195.5 526.3C187.6 510.5 194 491.3 209.8 483.4C225.6 475.5 244.8 481.9 252.7 497.7L255 502.4C258 508.3 264 512 270.6 512C280.2 512 288 504.2 288 494.6L288 392C288 374.3 302.3 360 320 360C337.7 360 352 374.3 352 392z"/></svg>
                        <span>
                            Regnar det får vi trängas inomhus istället.
                        </span>
                    </p>
                </div>
            </section>

            <FloralDivider />

            <section id="gavor" class="reveal-section scroll-mt-20 py-16">
                <SectionHeading
                    subtitle="Vi har allt vi behöver"
                    title="Inga gåvor"
                />

                <div
                    class="mt-10 space-y-5 text-[#3D2C35]/85"
                >
                    <p>
                        <strong>Vi önskar oss inget</strong> — vi har redan huset fullt med arvegods och porslin, mer går inte in.
                    </p>
                    <p>
                        Vill ni ändå ge något uppskattar vi om ni skriver ned tips på trevliga
                        utflyktsmål, böcker eller filmer — gärna med en kort
                        motivering om varför ni tror vi skulle gilla det.
                    </p>
                </div>
            </section>

            <FloralDivider />

            <section id="kladsel" class="reveal-section scroll-mt-20 py-16">
                <SectionHeading subtitle="Känn er bekväma" title="Klädsel" />

                <p
                    class="mt-10 text-center text-[#3D2C35]/90"
                >
                    Vi gillar att klä upp oss, men vill ni komma i
                    vardagsklädsel eller flannelpyjamas så går det också bra. Klä er i det ni känner er bekväma i.
                </p>
            </section>

            <FloralDivider />

            <section id="namn" class="reveal-section scroll-mt-20 py-16">
                <SectionHeading subtitle="Som gifta" title="Nääf Strömgren" />

                <figure class="mx-auto mt-10 max-w-md text-center">
                    <img
                        src="/images/tree-carving.png"
                        alt="Ristning i träd: A.N + A.S = A.N.S med ett hjärta runt"
                        class="mx-auto w-full rounded-sm"
                        loading="lazy"
                    />
                    <figcaption class="mt-6 text-[#3D2C35]/90">
                        Vi planerar att ta varandras efternamn. Som gifta kommer vi heta
                        Nääf Strömgren.
                    </figcaption>
                </figure>
            </section>
        </main>

        <footer class="relative z-10 border-t border-[#3D2C35]/8 px-6 py-12 text-center">
            <FloralDivider class="pb-2" />
            <p class="font-serif text-2xl text-[#3D2C35]">
                Amanda & Andreas
            </p>
            <p class="mt-2 text-sm tracking-widest text-accent-rose uppercase">
                1 augusti 2026
            </p>
        </footer>
    </div>
</template>

<script lang="ts">
import { defineComponent, h } from 'vue';

const SectionHeading = defineComponent({
    name: 'SectionHeading',
    props: {
        title: { type: String, required: true },
        subtitle: { type: String, required: true },
    },
    setup(props) {
        return () =>
            h('div', { class: 'text-center' }, [
                h(
                    'p',
                    {
                        class: 'text-sm tracking-[0.3em] text-accent-rose uppercase',
                    },
                    props.subtitle,
                ),
                h(
                    'h2',
                    {
                        class: 'mt-3 font-serif text-4xl font-light tracking-wide text-[#3D2C35] sm:text-5xl',
                    },
                    props.title,
                ),
                h('div', {
                    class: 'mx-auto mt-6 h-px w-16 bg-linear-to-r from-transparent via-[#C98FA0]/40 to-transparent',
                }),
            ]);
    },
});

const TimelineItem = defineComponent({
    name: 'TimelineItem',
    props: {
        badge: { type: String, required: true },
        time: { type: String, required: true },
        title: { type: String, required: true },
        location: { type: String, required: true },
        description: { type: String, required: true },
        showLine: { type: Boolean, default: false },
    },
    setup(props) {
        return () =>
            h('div', { class: 'relative flex gap-6' }, [
                h('div', { class: 'flex flex-col items-center' }, [
                    h('div', {
                        class: 'flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-[#C98FA0]/35 bg-[#F5EBEF] font-serif text-sm text-accent-rose shadow-sm',
                    }, props.badge),
                    props.showLine &&
                        h('div', {
                            class: 'mt-2 w-px grow bg-linear-to-b from-[#C98FA0]/30 to-[#C98FA0]/10',
                        }),
                ]),
                h('div', { class: props.showLine ? 'pb-8' : '' }, [
                    h(
                        'p',
                        {
                            class: 'text-sm tracking-widest text-accent-rose uppercase',
                        },
                        props.time,
                    ),
                    h(
                        'h3',
                        {
                            class: 'mt-1 font-serif text-2xl text-[#3D2C35]',
                        },
                        props.title,
                    ),
                    h(
                        'p',
                        {
                            class: 'mt-1 font-medium text-accent-rose',
                        },
                        props.location,
                    ),
                    h(
                        'p',
                        {
                            class: 'mt-3 text-[#3D2C35]/80',
                        },
                        props.description,
                    ),
                ]),
            ]);
    },
});

export default {
    components: {
        SectionHeading,
        TimelineItem,
    },
};
</script>

<style scoped>
.font-serif {
    font-family: 'Cormorant Garamond', Georgia, 'Times New Roman', serif;
}

.page-root::before {
    content: '';
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 1;
    opacity: 0.035;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
}

.ambient-gradient {
    background:
        radial-gradient(
            circle at 18% 22%,
            rgb(201 143 160 / 0.22) 0%,
            transparent 42%
        ),
        radial-gradient(
            circle at 82% 68%,
            rgb(184 122 142 / 0.18) 0%,
            transparent 40%
        ),
        radial-gradient(
            circle at 50% 100%,
            rgb(245 235 239 / 0.35) 0%,
            transparent 50%
        );
}

.ambient-gradient-shift {
    background-size:
        140% 140%,
        130% 130%,
        120% 120%;
    animation: ambient-gradient-shift 24s ease-in-out infinite;
}

@keyframes ambient-gradient-shift {
    0%,
    100% {
        background-position:
            0% 0%,
            100% 100%,
            50% 100%;
    }
    50% {
        background-position:
            100% 50%,
            0% 0%,
            50% 80%;
    }
}

@keyframes ambient-drift {
    0%,
    100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(2%, -3%) scale(1.04);
    }
    66% {
        transform: translate(-2%, 2%) scale(0.98);
    }
}

@keyframes ambient-drift-reverse {
    0%,
    100% {
        transform: translate(0, 0) scale(1);
    }
    33% {
        transform: translate(-2%, 2%) scale(1.03);
    }
    66% {
        transform: translate(3%, -2%) scale(0.97);
    }
}

.ambient-drift {
    animation: ambient-drift 18s ease-in-out infinite;
}

.ambient-drift-reverse {
    animation: ambient-drift-reverse 22s ease-in-out infinite;
}

@keyframes glow-pulse {
    0%,
    100% {
        opacity: 0.5;
    }
    50% {
        opacity: 0.85;
    }
}

@keyframes hero-fade-up {
    from {
        opacity: 0;
        transform: translateY(24px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.glow-pulse {
    animation: glow-pulse 10s ease-in-out infinite;
}

.hero-enter {
    opacity: 0;
    animation: hero-fade-up 1s ease-out forwards;
}

.hero-enter-delay-1 {
    animation-delay: 0.15s;
}

.hero-enter-delay-2 {
    animation-delay: 0.3s;
}

.hero-enter-delay-3 {
    animation-delay: 0.45s;
}

.hero-enter-delay-4 {
    animation-delay: 0.6s;
}

.hero-enter-delay-5 {
    animation-delay: 0.75s;
}

.reveal-section {
    opacity: 0;
    transform: translateY(36px);
    transition:
        opacity 0.9s cubic-bezier(0.22, 1, 0.36, 1),
        transform 0.9s cubic-bezier(0.22, 1, 0.36, 1);
}

.reveal-section.is-visible {
    opacity: 1;
    transform: translateY(0);
}

.card-hover {
    transition:
        transform 0.35s ease,
        box-shadow 0.35s ease,
        border-color 0.35s ease;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px -8px rgb(184 122 142 / 0.25);
    border-color: rgb(201 143 160 / 0.25);
}

@media (prefers-reduced-motion: reduce) {
    .ambient-gradient-shift,
    .ambient-drift,
    .ambient-drift-reverse,
    .glow-pulse,
    .hero-enter {
        animation: none;
        opacity: 1;
        transform: none;
    }

    .reveal-section {
        opacity: 1;
        transform: none;
        transition: none;
    }

    .card-hover:hover {
        transform: none;
    }
}
</style>
