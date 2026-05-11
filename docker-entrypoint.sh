#!/bin/sh

# Esperar a que la base de datos esté lista
echo "Esperando a que MySQL esté listo..."
until php -r "try { new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); exit(0); } catch (Exception \$e) { exit(1); }" > /dev/null 2>&1; do
  echo "MySQL no está listo aún - esperando..."
  sleep 2
done
echo "MySQL está listo."

# Generar la clave de la aplicación si no existe
if [ -z "$APP_KEY" ]; then
    echo "Generando APP_KEY..."
    php artisan key:generate --force
fi

# Crear el enlace simbólico para el almacenamiento
echo "Creando enlace simbólico de storage..."
php artisan storage:link --force

# Ejecutar migraciones
echo "Ejecutando migraciones..."
php artisan migrate --force

# Ejecutar seeders si la base de datos está vacía (opcional, ajustado a las necesidades)
# Si prefieres que siempre intente seedear, quita el condicional.
# Aquí simplemente lo ejecutamos para asegurar que los datos básicos existan.
echo "Ejecutando seeders..."
php artisan db:seed --force

# Construir los assets con Vite para producción
echo "Construyendo assets con Vite..."
npm run build

# Dar permisos correctos de nuevo por si acaso
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Iniciar Apache en primer plano
echo "Iniciando Apache..."
exec apache2-foreground
