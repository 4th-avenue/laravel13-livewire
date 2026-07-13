import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: true,
        port: process.env.VITE_PORT ? parseInt(process.env.VITE_PORT) : 5173,
        hmr: {
            host: 'localhost',
        },
    },
});
