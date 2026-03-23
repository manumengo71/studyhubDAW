# Usa una imagen base de PHP con Apache
FROM php:8.2.4-apache

# Instala dependencias necesarias para Laravel y habilita la extensión exif y gd de PHP
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

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copia la configuración de Apache al contenedor
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copia los archivos de tu proyecto Laravel al contenedor
COPY . .

# Instala las dependencias de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Instala Node.js 18.x y npm compatible
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Elimina el archivo package-lock.json y la carpeta node_modules si existen
RUN rm -rf package-lock.json node_modules

# Instala las dependencias de npm
RUN npm install

# Copia el archivo de configuración .env
COPY .env.example .env

# Cambia APP_URL a http://localhost:8000 en .env
RUN sed -i 's|APP_URL=http://localhost|APP_URL=http://localhost:8000|g' .env

# Genera la clave de aplicación de Laravel
RUN php artisan key:generate

# Establece los permisos adecuados
RUN chown -R www-data:www-data /var/www/html

# Expone el puerto 80 para el servidor web Apache
EXPOSE 80

# Expone el puerto 5173 para el servidor de desarrollo de Vite
EXPOSE 5173

# Crea el enlace simbólico para el almacenamiento público de Laravel
RUN php artisan storage:link

# Comando predeterminado para iniciar el servidor web Apache y Vite
CMD ["sh", "-c", "npm run dev & apache2-foreground"]
