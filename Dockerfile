# Utilizar una imagen base oficial de PHP 8.1 con Apache
FROM php:8.1-apache

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar y establecer los permisos de los archivos de la aplicación
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar el archivo de configuración de Apache
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Configurar las variables de entorno de PHP
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Instalar las dependencias de la aplicación Laravel
RUN composer install --no-scripts --no-autoloader
RUN composer dump-autoload --optimize

# Exponer el puerto 80 para el servidor web
EXPOSE 80

# Ejecutar el servidor web de Apache en primer plano
CMD ["apache2-foreground"]
