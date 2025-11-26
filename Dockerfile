# Use official PHP Apache image
FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install required PHP extensions
RUN apt-get update && apt-get install -y \
    libssl-dev \
    unzip \
    && docker-php-ext-install mysqli \
    && pecl install mongodb redis \
    && docker-php-ext-enable mongodb redis

# Enable Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files to Apache directory
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
