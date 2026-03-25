# Use a PHP base image with Apache
FROM php:8.2.4-apache

# Install necessary dependencies for Laravel and enable PHP extensions
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

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy Apache configuration file to the container
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files and install dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Copy project files to the container
COPY . .

# Install Node.js 18.x and npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Remove existing node_modules and package-lock.json if they exist
RUN rm -rf package-lock.json node_modules

# Install npm dependencies
RUN npm install

# Copy the environment file
COPY .env.example .env

# Change APP_URL to http://localhost:8000 in .env
RUN sed -i 's|APP_URL=http://localhost|APP_URL=http://localhost:8000|g' .env

# Generate Laravel application key
RUN php artisan key:generate

# Set appropriate permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for the Apache web server
EXPOSE 80

# Expose port 5173 for Vite development server
EXPOSE 5173

# Create the symbolic link for Laravel public storage
RUN php artisan storage:link

# Default command to start Apache and Vite development server
CMD ["sh", "-c", "npm run dev & apache2-foreground"]
