// import vue from '@vitejs/plugin-vue';
// import laravel from 'laravel-vite-plugin';
// import tailwindcss from '@tailwindcss/vite';
// import { defineConfig } from 'vite';

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ['resources/js/app.ts'],
//             ssr: 'resources/js/ssr.ts',
//             refresh: true,
//         }),
//         tailwindcss(),
//         vue({
//             template: {
//                 transformAssetUrls: {
//                     base: null,
//                     includeAbsolute: false,
//                 },
//             },
//         }),
//     ],
// });

import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/bootstrap-custom.scss', 'resources/js/app.ts'],
            // ssr: 'resources/js/ssr.ts', // Keep for potential future SSR use
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
});
