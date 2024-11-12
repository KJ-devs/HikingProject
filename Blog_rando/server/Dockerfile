# Dockerfile for Symfony

FROM php:latest

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

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
