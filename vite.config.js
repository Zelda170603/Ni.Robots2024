import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
<<<<<<< HEAD
                'resources/sass/app.scss',
                'resources/js/app.js',
=======
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/dark-mode.js'
>>>>>>> 9291b3c (PUSH LIBROS)
            ],
            refresh: true,
        }),
    ],
    //added to solve a problem with source map
    build: {
        sourcemap: true,
    }
});
