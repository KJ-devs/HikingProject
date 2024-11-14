# Dockerfile for Symfony

FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    libpq-dev \  
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_pgsql  # Install pdo_pgsql

# Set the working directory
WORKDIR /var/www/html

# Copy all application files including .env into the container
COPY . /var/www/html/

# Create the directory for Composer
RUN mkdir -p /usr/local/bin

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose port for PHP
EXPOSE 9000
CMD ["php", "-S", "0.0.0.0:9000", "-t", "public"]
