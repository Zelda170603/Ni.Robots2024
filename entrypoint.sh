#!/bin/bash
set -e

echo ">>> [Entrypoint] Starting Ni.Robots setup..."

# Ajustar permisos
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Esperar a la base de datos
echo ">>> Waiting for MySQL/MariaDB..."
until php -r "new PDO('mysql:host=${DB_HOST};port=${DB_PORT};dbname=${DB_DATABASE}', '${DB_USERNAME}', '${DB_PASSWORD}');" >/dev/null 2>&1; do
    echo ">>> Database not ready, retrying..."
    sleep 2
done
echo ">>> Database is ready."

# Ejecutar migraciones (en producción solo si querés)
if [ "$APP_ENV" = "production" ]; then
    echo ">>> Running migrations..."
    php artisan migrate --force
fi

# Cache de configuración
#php artisan config:cache

#php artisan route:cache
#php artisan view:cache

echo ">>> [Entrypoint] Setup complete. Starting PHP-FPM..."
exec "$@"
