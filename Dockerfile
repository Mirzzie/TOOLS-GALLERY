# Use a PHP base image
FROM php:7.4-apache

# Copy the application code to the container
COPY . /var/www/html

# Install PHP extensions and dependencies
RUN docker-php-ext-install mysqli pdo_mysql

# Set up Apache configuration
RUN a2enmod rewrite
COPY apache2.conf  /var/www/html/apache2.conf

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
