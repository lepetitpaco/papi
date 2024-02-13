# Use PHP 8.3 with Apache
FROM php:8.3-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install system dependencies and PHP extensions in one RUN statement to reduce image layers
RUN apt-get update && apt-get install -y \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        git \
        curl \
        libicu-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        libcurl4-openssl-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql mbstring xml curl zip bcmath intl gd

# Set the Apache document root to the Laravel public directory
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Update Apache configuration to point to the public directory and allow .htaccess Overrides
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && echo '<Directory ${APACHE_DOCUMENT_ROOT}>' >> /etc/apache2/conf-available/docker-laravel.conf \
    && echo '    AllowOverride All' >> /etc/apache2/conf-available/docker-laravel.conf \
    && echo '</Directory>' >> /etc/apache2/conf-available/docker-laravel.conf \
    && a2enconf docker-laravel

# Copy the application code to the container
COPY . /var/www/html

# Use the default development configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Adjust permissions to ensure www-data user can write to storage and cache
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 to access the Apache server
EXPOSE 80

# Start Apache server in the foreground
CMD ["apache2-foreground"]
