import { createInertiaApp } from '@inertiajs/vue3';

const defaultTitle = import.meta.env.VITE_APP_NAME || 'Amanda & Andreas · 1 augusti 2026';

createInertiaApp({
    title: (title) => title || defaultTitle,
    progress: {
        color: '#4B5563',
    },
});
