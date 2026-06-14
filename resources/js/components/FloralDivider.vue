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
            :animated="false"
            class="-rotate-12"
        />
        <BotanicalFlower
            variant="flower-3"
            :scale="1"
            :animated="false"
        />
        <BotanicalFlower
            variant="flower-4"
            :scale="0.9"
            :animated="false"
            class="rotate-12"
            flip
        />
    </div>
</template>
