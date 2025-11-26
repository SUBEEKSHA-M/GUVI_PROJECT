# Use PHP 8.1 with Apache
FROM php:8.1-apache

# Enable mysqli extension for MySQL
RUN docker-php-ext-install mysqli

# Install Redis and MongoDB extensions
RUN pecl install redis mongodb \
    && docker-php-ext-enable redis mongodb

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy your project files
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Install PHP dependencies (from composer.json)
RUN composer install

# Expose port 80
EXPOSE 80
