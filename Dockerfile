# =========================
# Base Image
# =========================
FROM php:8.3-apache

# =========================
# Enable Apache modules
# =========================
RUN a2enmod rewrite
RUN echo "ServerName localhost" > /etc/apache2/conf-available/servername.conf \
    && a2enconf servername

# =========================
# Install system dependencies
# =========================
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libpng-dev libonig-dev libxml2-dev postgresql-client \
    nodejs npm dos2unix \
    && docker-php-ext-install pdo pdo_pgsql mbstring bcmath gd

# =========================
# Set document root
# =========================
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf \
    /etc/apache2/conf-available/*.conf

# =========================
# Composer
# =========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================
# Working directory
# =========================
WORKDIR /var/www/html

# =========================
# Copy project files
# =========================
COPY . .

# =========================
# Fix line endings of entrypoint (prevent exec format error)
# =========================
RUN dos2unix docker-entrypoint.sh

# =========================
# Ensure storage & cache folders exist
# =========================
RUN mkdir -p storage/framework/{views,cache,sessions,testing} \
    && mkdir -p storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# =========================
# Install PHP dependencies
# =========================
RUN composer install --no-dev --optimize-autoloader

# =========================
# Install Node dependencies + build frontend
# =========================
RUN npm install && npm run build

# =========================
# Expose port
# =========================
EXPOSE 80

# =========================
# Copy entrypoint
# =========================
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
CMD ["apache2-foreground"]
