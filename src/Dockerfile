FROM php:7.4-apache

ENV COMPOSER_ALLOW_SUPERUSER 1

# Install the necessary PHP extensions
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-install session
RUN docker-php-ext-enable session

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code to the Docker image
COPY . /var/www/html/

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Run composer install to install the project dependencies
RUN apt-get update && apt-get install git -y
RUN composer install
RUN composer dump-autoload