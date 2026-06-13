<script setup lang="ts">
import { computed } from 'vue';

const variants = {
    'flower-1': { aspect: 423.03 / 497.59 },
    'flower-2': { aspect: 377.97 / 487.79 },
    'flower-3': { aspect: 419.08 / 492.64 },
    'flower-4': { aspect: 423.89 / 471.97 },
} as const;

type BotanicalVariant = keyof typeof variants;

const props = withDefaults(
    defineProps<{
        variant?: BotanicalVariant;
        scale?: number;
        flip?: boolean;
    }>(),
    {
        variant: 'flower-1',
        scale: 1,
        flip: false,
    },
);

const src = computed(() => `/images/flowers/${props.variant}.svg`);

const size = computed(() => {
    const height = 56 * props.scale;
    const aspect = variants[props.variant].aspect;

    return {
        height,
        width: height * aspect,
    };
});
</script>

<template>
    <img
        :src="src"
        alt=""
        aria-hidden="true"
        class="botanical-flower shrink-0"
        :class="flip ? '-scale-x-100' : undefined"
        :width="size.width"
        :height="size.height"
    />
</template>

<style scoped>
.botanical-flower {
    opacity: 0.82;
    filter: drop-shadow(0 1px 2px rgb(61 44 53 / 10%));
}
</style>
