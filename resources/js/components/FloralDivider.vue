<script setup lang="ts">
import BotanicalFlower from './BotanicalFlower.vue';
</script>

<template>
    <div
        class="pointer-events-none flex items-end justify-center gap-4 py-6"
        aria-hidden="true"
    >
        <BotanicalFlower
            variant="flower-2"
            :scale="0.85"
            class="flower-sway -rotate-12"
            style="animation-delay: 0s"
        />
        <BotanicalFlower
            variant="flower-3"
            :scale="1"
            class="flower-sway"
            style="animation-delay: 0.4s"
        />
        <BotanicalFlower
            variant="flower-4"
            :scale="0.9"
            class="flower-sway rotate-12"
            flip
            style="animation-delay: 0.8s"
        />
    </div>
</template>
