# Usamos una imagen de PHP con Apache ya configurado
FROM php:8.2.4-apache

# Instalamos las librerías necesarias para que Laravel y sus extensiones funcionen bien
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-install zip pdo_mysql exif \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && a2enmod rewrite

# Nos situamos en la carpeta donde va a estar la web
WORKDIR /var/www/html

# Metemos nuestra configuración de Apache en el sitio que toca
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Instalamos Composer para gestionar las librerías de PHP
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Traemos los archivos de dependencias y las instalamos (sin las de desarrollo)
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --ignore-platform-reqs --no-scripts

# Copiamos todo el código del proyecto al contenedor
COPY . .

# Instalamos Node.js para poder compilar los estilos y el JS
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Limpiamos instalaciones antiguas para evitar líos
RUN rm -rf package-lock.json node_modules

# Instalamos todas las librerías de Node
RUN npm install

# Preparamos el archivo de configuración .env
COPY .env.example .env

# Ajustamos la URL de la aplicación para que funcione en el puerto 8000
RUN sed -i 's|APP_URL=http://localhost|APP_URL=http://localhost:8000|g' .env

# Generamos la clave de seguridad de Laravel
RUN php artisan key:generate

# Traemos el script que se encarga de arrancar todo al encender el contenedor
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Nos aseguramos de que los permisos de las carpetas sean los correctos para Apache
RUN chown -R www-data:www-data /var/www/html

# Abrimos el puerto 80 para que la web sea accesible
EXPOSE 80

# Le decimos al contenedor que use nuestro script de arranque
ENTRYPOINT ["docker-entrypoint.sh"]
