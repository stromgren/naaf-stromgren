<script setup lang="ts">
import { computed } from 'vue';

defineOptions({
    inheritAttrs: false,
});

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
        animated?: boolean;
        delay?: number;
        duration?: number;
    }>(),
    {
        variant: 'flower-1',
        scale: 1,
        flip: false,
        animated: true,
        delay: 0,
        duration: 9,
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

const motionStyle = computed(() => ({
    animationDelay: `${props.delay}s`,
    animationDuration: `${props.duration}s`,
}));
</script>

<template>
    <div class="botanical-flower-root" v-bind="$attrs">
        <div
            class="botanical-flower-drift"
            :class="{ 'botanical-flower-drift--static': !animated }"
            :style="animated ? motionStyle : undefined"
        >
            <img
                :src="src"
                alt=""
                aria-hidden="true"
                class="botanical-flower shrink-0"
                :class="flip ? '-scale-x-100' : undefined"
                :width="size.width"
                :height="size.height"
            />
        </div>
    </div>
</template>

<style scoped>
.botanical-flower-drift {
    transform-origin: center bottom;
    animation: botanical-flower-drift ease-in-out infinite;
}

.botanical-flower-drift--static {
    animation: none;
}

.botanical-flower {
    opacity: 0.82;
    filter: drop-shadow(0 1px 2px rgb(61 44 53 / 10%));
}

@keyframes botanical-flower-drift {
    0%,
    100% {
        transform: translate(0, 0) rotate(-5deg);
    }

    25% {
        transform: translate(5px, -10px) rotate(4deg);
    }

    50% {
        transform: translate(-4px, -16px) rotate(6deg);
    }

    75% {
        transform: translate(-6px, -7px) rotate(-3deg);
    }
}

@media (prefers-reduced-motion: reduce) {
    .botanical-flower-drift {
        animation: none;
    }
}
</style>
