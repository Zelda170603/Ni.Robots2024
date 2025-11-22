import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS principal
                'resources/css/app.css',

                // JS sueltos
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/chatbot.js',
                'resources/js/dark-mode.js',
                'resources/js/getcoordinates.js',
                'resources/js/notificaciones.js',
                'resources/js/stepper.js',
                'resources/js/chart.js',

                // JS de subcarpetas
                'resources/js/appointments/createWithMedico.js',
                'resources/js/centros_Atencion/cargar_centros_municipios.js',
                'resources/js/centros_Atencion/cargar_centros.js',
                'resources/js/doctores/doctor.js',
                'resources/js/fabricantes/poppover.js', // corregido typo
                'resources/js/Mensajes/contactos_search.js',
                'resources/js/Mensajes/mensajes.js',
                'resources/js/productos/calificar_prod.js',
                'resources/js/productos/carrito.js',
                'resources/js/productos/ops_carrito_compra.js',
                'resources/js/productos/productos.js',
                'resources/js/productos/send_compra.js',
                'resources/js/books/libros.js',
                'resources/js/books/loadpdf.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        sourcemap: true,
    },
});
