// import '../css/app.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js'; // Add Bootstrap JS
import '../css/bootstrap-custom.scss';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import 'bootstrap-icons/font/bootstrap-icons.css';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';

const appName = import.meta.env.VITE_APP_NAME || 'LyriSearch';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob<DefineComponent>('./pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        // color: '#4B5563',
        color: '#007bff', // Match Bootstrap’s primary color
    },
});

// This will set light / dark mode on page load...
initializeTheme();
