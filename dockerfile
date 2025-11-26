# Use official PHP 8.2 Apache image
FROM php:8.2-apache

# Set working directory inside container
WORKDIR /var/www/html

# Install system dependencies for PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpng-dev libonig-dev \
    && docker-php-ext-install zip mysqli pdo pdo_mysql \
    && pecl install mongodb redis \
    && docker-php-ext-enable mongodb redis

# Enable Apache mod_rewrite (needed for routing, optional)
RUN a2enmod rewrite

# Install Composer globally
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy project files into container
COPY . .

# Install PHP dependencies using Composer
RUN composer install --no-dev --optimize-autoloader

# Expose port 80 for Render
EXPOSE 80

# Start Apache in foreground
CMD ["apache2-foreground"]
