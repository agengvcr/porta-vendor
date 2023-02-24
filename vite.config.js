import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/style.bundle.css',
                'resources/plugins/global/plugins.bundle.css',
                'resources/css/app.css',
                'resources/js/app.js',
                '/node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css'
                // 'resources/plugins/global/plugins.bundle.js',
                // 'resources/js/scripts.bundle.js',                
            ],
            refresh: true,
        }),
        {
            name: 'blade',
            handleHotUpdate({ file, server }) {
                if (file.endsWith('.blade.php')) {
                    server.ws.send({
                        type: 'full-reload',
                        path: '*',
                    });
                }
            },
        }
    ],
    build: {
        assetsInlineLimit: 2048,
        chunkSizeWarningLimit: 1600
    },
});
