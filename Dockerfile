# Use the official PHP image
FROM --platform=linux/amd64 php:8.2.5-fpm

# Set the working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
        unzip \
        git \
        curl \
        libonig-dev \
        libxml2-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev && \
    docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer --version

# Copy project files to the container
COPY . .

# Install project dependencies
RUN composer install --no-interaction

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
