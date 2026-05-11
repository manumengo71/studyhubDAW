#!/bin/sh

# 1. Blindamos el archivo .env nada más arrancar
# Esto sobreescribe cualquier valor local que pueda dar problemas en Docker
if [ -f .env ]; then
    # Usamos una expresión más fuerte para limpiar espacios y forzar valores
    sed -i 's/^[[:space:]]*DB_HOST[[:space:]]*=.*/DB_HOST=mi-mysql/' .env
    sed -i 's/^[[:space:]]*DB_DATABASE[[:space:]]*=.*/DB_DATABASE=studyhub_app/' .env
    sed -i 's/^[[:space:]]*DB_USERNAME[[:space:]]*=.*/DB_USERNAME=root/' .env
    sed -i 's/^[[:space:]]*DB_PASSWORD[[:space:]]*=.*/DB_PASSWORD=root/' .env
fi

# Nos aseguramos de que la base de datos esté lista antes de seguir
echo "Esperando a que MySQL esté listo..."
until php -r "try { new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); exit(0); } catch (Exception \$e) { exit(1); }" > /dev/null 2>&1; do
  echo "Aún no está lista... esperamos un poquito más..."
  sleep 2
done
echo "MySQL está listo."

# Si no hay una clave de aplicación, la generamos ahora mismo
if [ -z "$APP_KEY" ]; then
    echo "Generando APP_KEY..."
    php artisan key:generate --force
fi

# Creamos el acceso directo para que las imágenes y archivos se vean en la web
echo "Configurando el acceso a los archivos de storage..."
php artisan storage:link --force

# El resto de comandos (migraciones y seeders) los ejecutaremos 
# manualmente durante la defensa para demostrar el funcionamiento.


# Compilamos el CSS y el JS para que la web se vea perfecta
echo "Preparando los estilos y el JavaScript de la web..."
npm run build

# Revisamos los permisos una última vez para evitar errores de escritura
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# ¡Todo listo! Arrancamos el servidor Apache
echo "¡Todo listo! Arrancando el servidor..."
exec apache2-foreground
