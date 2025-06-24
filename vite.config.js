import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import path from 'path'
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'localhost'
        }
    },
    build: {
        outDir: '../../public/division-enhanced',
        emptyOutDir: true,
        manifest: true,
        rollupOptions: {
            input: {
                app: path.resolve(__dirname, 'css/app.css'),
                js: path.resolve(__dirname, 'js/app.js'),
            }
        }
    },
    plugins: [
        laravel({
            input: [
                path.resolve(__dirname, 'js/app.js'),
                path.resolve(__dirname, 'css/app.css'),
            ],
            buildDirectory: 'division-enhanced/',
            refresh: true
        }),
        tailwindcss(),
    ],
})
