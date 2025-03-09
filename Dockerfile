# Usa la imagen base de PHP con Apache
FROM php:8.4-apache as web

# Instala dependencias del sistema y Node.js/npm
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    zip \
    nodejs \
    npm \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure intl

# Habilita mod_rewrite y configura Apache
RUN a2enmod rewrite \
    && sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Instala extensiones PHP
RUN docker-php-ext-install pdo_mysql zip intl

# Configura el DocumentRoot de Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e "s|/var/www/html|${APACHE_DOCUMENT_ROOT}|g" /etc/apache2/sites-available/*.conf

# Copia el código de la aplicación
COPY . /var/www/html

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala Composer y dependencias PHP
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# Instala dependencias de Node.js y compila los assets
RUN npm install && npm run build

# Ajusta permisos (usando usuario adecuado)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache