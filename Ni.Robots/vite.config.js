import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS principal
                'resources/css/app.css',

                // JS base
                'resources/js/app.js',
                'resources/js/bootstrap.js',
                'resources/js/chatbot.js',
                'resources/js/dark-mode.js',
                'resources/js/getcoordinates.js',
                'resources/js/notificaciones.js',
                'resources/js/stepper.js',
                'resources/js/chart.js',

                // Appointments
                'resources/js/appointments/create.js',
                'resources/js/appointments/createWithMedico.js',

                // Centros de atención
                'resources/js/centros_Atencion/cargar_centros.js',
                'resources/js/centros_Atencion/cargar_centros_municipios.js',

                // Doctores
                'resources/js/doctores/doctor.js',

                // Fabricantes
                'resources/js/fabricantes/poppover.js',

                // Mensajes
                'resources/js/Mensajes/contactos_search.js',
                'resources/js/Mensajes/mensajes.js',

                // Productos
                'resources/js/productos/calificar_prod.js',
                'resources/js/productos/carrito.js',
                'resources/js/productos/ops_carrito_compra.js',
                'resources/js/productos/productos.js',
                'resources/js/productos/send_compra.js',

                // Books
                'resources/js/books/libros.js',
                'resources/js/books/loadpdf.js',
                'resources/js/books/modal-pdf.js',

                // Resources (subcarpeta)
                'resources/js/resources/Cargar_ciudades_departamentos.js',
                'resources/js/resources/Cargas_Tipos_niveles_Afectacion.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        sourcemap: true,
    },
    server: {
        host: '0.0.0.0',
        port: 5173,
        strictPort: true,
        hmr: {
            host: '192.168.1.165', // tu IP LAN
            port: 5173,
        },
    },
});
